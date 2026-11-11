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


class BudgetController extends Controller
{
    /**
     * Display all budgets belonging to the authenticated user.
     */
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
