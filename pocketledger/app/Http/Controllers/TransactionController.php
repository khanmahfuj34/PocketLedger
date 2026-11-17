<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use App\Models\Scopes\ActiveCategoryScope;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use OpenApi\Attributes as OA;

class TransactionController extends Controller
{
    use AuthorizesRequests;
    #[OA\Get(
        path: '/transactions',
        operationId: 'listTransactions',
        summary: 'List user transactions',
        description: 'Retrieves a paginated list of transactions belonging to the authenticated user, eager-loading category relations and sorted chronologically.',
        tags: ['Transactions'],
        security: [['cookieAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'page',
                in: 'query',
                required: false,
                description: 'Page number for pagination (default: 1)',
                schema: new OA\Schema(type: 'integer', default: 1)
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Paginated transactions list',
                content: new OA\JsonContent(ref: '#/components/schemas/PaginatedTransactionsResponse')
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function index()
    {
        //Authorization check
        $this->authorize('viewAny', Transaction::class);
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

    #[OA\Post(
        path: '/transactions',
        operationId: 'storeTransaction',
        summary: 'Create a new transaction',
        description: 'Records a new income or expense transaction for the authenticated user and active user category.',
        tags: ['Transactions'],
        security: [['cookieAuth' => []], ['csrfToken' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Transaction details',
            content: new OA\JsonContent(ref: '#/components/schemas/StoreTransactionRequest')
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Transaction created successfully'
            ),
            new OA\Response(
                response: 302,
                description: 'Transaction recorded. Redirecting to create form with success notice.'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ]
    )]
    public function store(Request $request)
    {
        $this->authorize('create', Transaction::class);
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

    #[OA\Get(
        path: '/transactions/{id}',
        operationId: 'showTransaction',
        summary: 'Retrieve single transaction details',
        description: 'Fetches details of a specific transaction belonging to the authenticated user.',
        tags: ['Transactions'],
        security: [['cookieAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Transaction ID',
                schema: new OA\Schema(type: 'integer', format: 'int64')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Transaction retrieved successfully',
                content: new OA\MediaType(
                    mediaType: 'text/plain',
                    schema: new OA\Schema(type: 'string', example: 'Transaction: Lunch at Cafe - ৳350.00')
                )
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Transaction not found or unauthorized access',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function show(string $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaction = $user->transactions()
            ->with('category')
            ->findOrFail($id);

        $this->authorize('view', $transaction);

        return "Transaction: {$transaction->title} - ৳{$transaction->amount}";
    }

    // Show Edit Form
    public function edit($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaction = $user->transactions()
            ->findOrFail($id);

        $this->authorize('update', $transaction);

        if ($user->categories()->count() === 0) {
            $user->createDefaultCategories();
        }

        $categories = $user->categories()
            ->withoutGlobalScope(ActiveCategoryScope::class)
            ->where(function ($query) use ($transaction) {
                $query->where('is_active', true)
                    ->orWhere('id', $transaction->category_id);
            })
            ->orderBy('name')
            ->get();

        return view('transactions.edit', compact(
            'transaction',
            'categories'
        ));
    }

    #[OA\Put(
        path: '/transactions/{id}',
        operationId: 'updateTransaction',
        summary: 'Update an existing transaction',
        description: 'Updates fields of a transaction belonging to the authenticated user.',
        tags: ['Transactions'],
        security: [['cookieAuth' => []], ['csrfToken' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Transaction ID',
                schema: new OA\Schema(type: 'integer', format: 'int64')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Updated transaction payload',
            content: new OA\JsonContent(ref: '#/components/schemas/UpdateTransactionRequest')
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Transaction updated successfully'
            ),
            new OA\Response(
                response: 302,
                description: 'Transaction updated. Redirecting to transaction list.'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Transaction not found',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ]
    )]
    public function update(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaction = $user->transactions()
            ->findOrFail($id);

        // Policy authorization
        $this->authorize('update', $transaction);

        $validated = $request->validate([
            'category_id' => [
                'required',
                Rule::exists('categories', 'id')
                    ->where('user_id', Auth::id())
                    ->when($request->category_id != $transaction->category_id, function ($query) {
                        return $query->where('is_active', true);
                    }),
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

    #[OA\Delete(
        path: '/transactions/{id}',
        operationId: 'deleteTransaction',
        summary: 'Soft-delete a transaction',
        description: 'Marks a transaction as deleted for the authenticated user, excluding it from active queries.',
        tags: ['Transactions'],
        security: [['cookieAuth' => []], ['csrfToken' => []]],
        parameters: [
            new OA\Parameter(
                name: 'id',
                in: 'path',
                required: true,
                description: 'Transaction ID',
                schema: new OA\Schema(type: 'integer', format: 'int64')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Transaction deleted successfully'
            ),
            new OA\Response(
                response: 302,
                description: 'Transaction deleted. Redirecting to transaction list.'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Transaction not found',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $transaction = $user->transactions()
            ->findOrFail($id);

        $this->authorize('delete', $transaction);

        $transaction->delete();

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction deleted successfully!');
    }
    
}