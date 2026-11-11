<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    public function index(): View
    {
        $user = Auth::user();

        $dataStats = [
            'transactionsCount' => $user->transactions()->withTrashed()->count(),
            'budgetsCount' => $user->budgets()->count(),
            'attachmentsCount' => $user->attachments()->count(),
        ];

        return view('settings.index', compact('user', 'dataStats'));
    }

    /**
     * Clear all user's financial data safely inside a transaction.
     */
    public function clearData(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'string'],
            'confirmation' => ['required', 'in:CLEAR'],
        ], [
            'confirmation.in' => 'You must type CLEAR in uppercase to confirm.',
            'password.required' => 'Password is required to verify your identity.',
        ]);

        $user = Auth::user();

        // Verify password
        if (!Hash::check($request->password, $user->password)) {
            return back()
                ->withErrors(['password' => 'The provided password does not match our records.'])
                ->withInput();
        }

        // Perform safe transactional deletion
        DB::transaction(function () use ($user) {
            // 1. Delete attachments and clean up storage files
            $attachments = $user->attachments()->get();
            foreach ($attachments as $attachment) {
                if ($attachment->file_path && Storage::disk($attachment->storage_disk ?? 'public')->exists($attachment->file_path)) {
                    Storage::disk($attachment->storage_disk ?? 'public')->delete($attachment->file_path);
                }
                $attachment->delete();
            }

            // 2. Delete all transactions (including soft-deleted ones)
            $user->transactions()->withTrashed()->forceDelete();

            // 3. Delete all budgets
            $user->budgets()->delete();
        });

        return redirect()->route('settings.index')->with('success', 'All financial data (transactions, budgets, and attachments) has been permanently cleared.');
    }
}

