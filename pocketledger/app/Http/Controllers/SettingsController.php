<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

class SettingsController extends Controller
{
    /**
     * Display the settings page.
     */
    #[OA\Get(
        path: '/settings',
        operationId: 'getSettings',
        summary: 'View settings and data counts',
        description: 'Displays user settings page with summary counts of total transactions, budgets, and storage attachments.',
        tags: ['Settings'],
        security: [['cookieAuth' => []]],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Settings page loaded successfully'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
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
    #[OA\Post(
        path: '/settings/clear-data',
        operationId: 'clearUserData',
        summary: 'Clear all user financial records',
        description: 'Permanently removes all transactions, attachments, and budgets for the authenticated user inside an atomic database transaction. Requires password re-authentication and typing "CLEAR".',
        tags: ['Settings'],
        security: [['cookieAuth' => []], ['csrfToken' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Password and CLEAR confirmation',
            content: new OA\JsonContent(ref: '#/components/schemas/ClearDataRequest')
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Financial data successfully purged'
            ),
            new OA\Response(
                response: 302,
                description: 'Financial data purged. Redirecting to settings page with confirmation notice.'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error (e.g. invalid password or missing CLEAR string)',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ]
    )]
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

