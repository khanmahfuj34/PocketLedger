<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TransactionController extends Controller
{
    // List Transactions
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transactions = $user->transactions()
            ->with('category')
            ->latest('transaction_date')
            ->latest('id')
            ->paginate(10);
        return view('transactions.index', compact('transactions'));
    }

    // Show Transaction Form
    public function create()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Ensure default categories exist if the user has none
        if ($user->categories()->count() === 0) {
            $user->createDefaultCategories();
        }

        $categories = $user->categories()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('transactions.create', compact('categories'));
    }

    // Store Transaction
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where('user_id', Auth::id())
                    ->where('is_active', true),
            ],
            'title' => 'required|string|max:150',
            'amount' => 'required|numeric|gt:0',
            'transaction_date' => 'required|date',
            'payment_method' => 'required|string|max:30',
            'note' => 'nullable|string',
        ]);

        $transaction = Transaction::create([
            ...$validated,
            'user_id' => Auth::id(),
        ]);

        return redirect()
            ->route('transactions.create')
            ->with('success', 'Transaction created successfully!');
    }

    // Show Single Transaction
    public function show(string $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaction = $user->transactions()
            ->with('category')
            ->findOrFail($id);

        return "Transaction: {$transaction->title} - ৳{$transaction->amount}";
    }

    // Show Edit Form
    public function edit($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaction = $user->transactions()
            ->findOrFail($id);

        if ($user->categories()->count() === 0) {
            $user->createDefaultCategories();
        }

        $categories = $user->categories()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('transactions.edit', compact(
            'transaction',
            'categories'
        ));
    }

    // Update Transaction
    public function update(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaction = $user->transactions()
            ->findOrFail($id);

        $validated = $request->validate([
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where('user_id', Auth::id())
                    ->where('is_active', true),
            ],
            'title' => 'required|string|max:150',
            'amount' => 'required|numeric|gt:0',
            'transaction_date' => 'required|date',
            'payment_method' => 'required|string|max:30',
            'note' => 'nullable|string',
        ]);

        $transaction->update($validated);

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction updated successfully!');
    }

    // Delete Transaction
    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaction = $user->transactions()
            ->findOrFail($id);

        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction deleted successfully!');
    }
    
}