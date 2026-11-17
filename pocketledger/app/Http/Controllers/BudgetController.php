<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBudgetRequest;
use App\Http\Requests\UpdateBudgetRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Services\BudgetService;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class BudgetController extends Controller
{
    /**
     * Display all budgets belonging to the authenticated user.
     */
    #[OA\Get(
        path: '/budgets',
        operationId: 'listBudgets',
        summary: 'List user budgets with monthly progress',
        description: 'Retrieves all category budgets belonging to the authenticated user for the selected or current month, including spending calculations and progress metrics.',
        tags: ['Budgets'],
        security: [['cookieAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'month',
                in: 'query',
                required: false,
                description: 'Target month in YYYY-MM format (defaults to current month)',
                schema: new OA\Schema(type: 'string', example: '2026-11')
            ),
            new OA\Parameter(
                name: 'page',
                in: 'query',
                required: false,
                description: 'Pagination page number',
                schema: new OA\Schema(type: 'integer', default: 1)
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Budgets list and progress loaded successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/PaginatedBudgetsResponse')
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Invalid month format',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ]
    )]
    public function index(Request $request, BudgetService $budgetService): View
    {
        $validated = $request->validate([
            'month' => ['nullable', 'date_format:Y-m'],
        ]);

        $tz = config('app.timezone', 'Asia/Dhaka');

        $query = $request->user()
            ->budgets()
            ->with('category')
            ->orderByDesc('budget_month')
            ->orderBy('category_id');

        if (!empty($validated['month'])) {
            $selectedMonth = CarbonImmutable::createFromFormat(
                '!Y-m',
                $validated['month'],
                $tz
            );
            $query->whereDate(
                'budget_month',
                $selectedMonth->startOfMonth()->toDateString()
            );
        } else {
            $selectedMonth = CarbonImmutable::now($tz)->startOfMonth();
        }

        // Paginate budgets
        $budgets = $query->paginate(10)->withQueryString();

        // Calculate spending and budget status
        $budgetProgress = $budgetService
            ->getMonthlyProgress(
                $request->user(),
                $selectedMonth
            )
            ->keyBy('id');

        return view('budgets.index', compact(
            'budgets',
            'budgetProgress',
            'selectedMonth'
        ));
    }

    /**
     * Show the create budget form.
     */
    public function create(): View
    {
        /** @var User $user */
        $user = Auth::user();

        // Ensure default categories exist if the user has none
        if ($user->categories()->count() === 0) {
            $user->createDefaultCategories();
        }

        $categories = $user->categories()
            ->where('type', 'expense')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('budgets.create', compact('categories'));
    }

    /**
     * Store a newly created budget.
     */
    #[OA\Post(
        path: '/budgets',
        operationId: 'storeBudget',
        summary: 'Create a monthly category budget',
        description: 'Creates a new budget for an active user expense category in a given month. Prevents duplicate budgets for the same category and month.',
        tags: ['Budgets'],
        security: [['cookieAuth' => []], ['csrfToken' => []]],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Budget creation parameters',
            content: new OA\JsonContent(ref: '#/components/schemas/StoreBudgetRequest')
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: 'Budget created successfully'
            ),
            new OA\Response(
                response: 302,
                description: 'Budget created. Redirecting to budget index.'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error (e.g. invalid category, duplicate budget for month, invalid amount)',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ]
    )]
    public function store(StoreBudgetRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $user->budgets()->create($request->validated());

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Monthly budget created successfully.');
    }

    /**
     * Show the edit budget form.
     */
    public function edit(string $budget): View
    {
        /** @var User $user */
        $user = Auth::user();

        $budgetItem = $user->budgets()
            ->with('category')
            ->findOrFail($budget);

        $categories = $user->categories()
            ->where('type', 'expense')
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('budgets.edit', [
            'budget' => $budgetItem,
            'categories' => $categories,
        ]);
    }

    /**
     * Update an existing budget.
     */
    #[OA\Put(
        path: '/budgets/{budget}',
        operationId: 'updateBudget',
        summary: 'Update an existing budget',
        description: 'Updates category, amount, or budget month of an existing user budget.',
        tags: ['Budgets'],
        security: [['cookieAuth' => []], ['csrfToken' => []]],
        parameters: [
            new OA\Parameter(
                name: 'budget',
                in: 'path',
                required: true,
                description: 'Budget ID',
                schema: new OA\Schema(type: 'integer', format: 'int64')
            ),
        ],
        requestBody: new OA\RequestBody(
            required: true,
            description: 'Updated budget payload',
            content: new OA\JsonContent(ref: '#/components/schemas/UpdateBudgetRequest')
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: 'Budget updated successfully'
            ),
            new OA\Response(
                response: 302,
                description: 'Budget updated. Redirecting to budget index.'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Budget not found',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ]
    )]
    public function update(
        UpdateBudgetRequest $request,
        string $budget
    ): RedirectResponse {
        /** @var User $user */
        $user = Auth::user();

        $budgetItem = $user->budgets()
            ->findOrFail($budget);

        $budgetItem->update($request->validated());

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Monthly budget updated successfully.');
    }

    /**
     * Delete an existing budget.
     */
    #[OA\Delete(
        path: '/budgets/{budget}',
        operationId: 'deleteBudget',
        summary: 'Delete a budget',
        description: 'Permanently removes a monthly budget item for the authenticated user.',
        tags: ['Budgets'],
        security: [['cookieAuth' => []], ['csrfToken' => []]],
        parameters: [
            new OA\Parameter(
                name: 'budget',
                in: 'path',
                required: true,
                description: 'Budget ID to delete',
                schema: new OA\Schema(type: 'integer', format: 'int64')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Budget deleted successfully'
            ),
            new OA\Response(
                response: 302,
                description: 'Budget deleted. Redirecting to budget index.'
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 404,
                description: 'Budget not found',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
        ]
    )]
    public function destroy(string $budget): RedirectResponse
    {
        /** @var User $user */
        $user = Auth::user();

        $budgetItem = $user->budgets()
            ->findOrFail($budget);

        $budgetItem->delete();

        return redirect()
            ->route('budgets.index')
            ->with('success', 'Monthly budget deleted successfully.');
    }
}
