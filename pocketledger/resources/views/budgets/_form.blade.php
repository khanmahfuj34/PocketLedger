@csrf

<div class="space-y-6">

    {{-- Expense Category --}}
    <div>
        <label for="category_id" class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-2">
            Expense Category <span class="text-rose-500">*</span>
        </label>

        <div class="relative">
            <select
                id="category_id"
                name="category_id"
                required
                class="w-full appearance-none rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900/90 px-4 py-3.5 pr-10 text-sm font-semibold text-slate-900 dark:text-white shadow-xs focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition-all @error('category_id') border-rose-500 dark:border-rose-500 ring-4 ring-rose-500/10 @enderror"
            >
                <option value="" disabled {{ old('category_id', $budget->category_id ?? '') == '' ? 'selected' : '' }}>
                    Select an expense category
                </option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected((string) old('category_id', $budget->category_id ?? '') === (string) $category->id)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>

            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 dark:text-slate-500">
                <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>

        @error('category_id')
            <p class="mt-2 text-xs font-semibold text-rose-500 flex items-center gap-1.5">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{{ $message }}</span>
            </p>
        @enderror
    </div>

    {{-- Budget Month --}}
    <div>
        <label for="budget_month" class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-2">
            Budget Month <span class="text-rose-500">*</span>
        </label>

        @php
            $defaultMonth = isset($budget) && $budget->budget_month
                ? $budget->budget_month->format('Y-m')
                : now()->format('Y-m');
            $monthValue = old('budget_month', $defaultMonth);
            // Ensure monthValue is YYYY-MM if full date was passed in old input
            if (is_string($monthValue) && strlen($monthValue) > 7) {
                $monthValue = substr($monthValue, 0, 7);
            }
        @endphp

        <div class="relative">
            <input
                type="month"
                id="budget_month"
                name="budget_month"
                required
                value="{{ $monthValue }}"
                class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900/90 px-4 py-3.5 text-sm font-semibold text-slate-900 dark:text-white shadow-xs focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition-all @error('budget_month') border-rose-500 dark:border-rose-500 ring-4 ring-rose-500/10 @enderror"
            />
        </div>

        <p class="mt-1.5 text-[11px] text-slate-400 dark:text-slate-500">
            Select the calendar month for which this spending limit applies.
        </p>

        @error('budget_month')
            <p class="mt-2 text-xs font-semibold text-rose-500 flex items-center gap-1.5">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{{ $message }}</span>
            </p>
        @enderror
    </div>

    {{-- Budget Amount --}}
    <div>
        <label for="amount" class="block text-xs font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400 mb-2">
            Monthly Spending Limit Amount (৳ BDT) <span class="text-rose-500">*</span>
        </label>

        @php
            $amountValue = old('amount', isset($budget) && $budget->amount ? number_format((float) $budget->amount, 2, '.', '') : '');
        @endphp

        <div class="relative">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-emerald-600 dark:text-emerald-400 font-bold text-base">
                ৳
            </div>

            <input
                type="number"
                id="amount"
                name="amount"
                min="0.01"
                step="0.01"
                required
                value="{{ $amountValue }}"
                placeholder="5000.00"
                class="w-full rounded-2xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900/90 pl-10 pr-4 py-3.5 text-sm font-semibold text-slate-900 dark:text-white shadow-xs focus:border-emerald-500 focus:outline-none focus:ring-4 focus:ring-emerald-500/10 transition-all @error('amount') border-rose-500 dark:border-rose-500 ring-4 ring-rose-500/10 @enderror"
            />
        </div>

        <p class="mt-1.5 text-[11px] text-slate-400 dark:text-slate-500">
            Specify the maximum amount you plan to spend in this category for the month.
        </p>

        @error('amount')
            <p class="mt-2 text-xs font-semibold text-rose-500 flex items-center gap-1.5">
                <svg class="w-4 h-4 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{{ $message }}</span>
            </p>
        @enderror
    </div>

    {{-- Action Buttons --}}
    <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 pt-4 border-t border-slate-100 dark:border-slate-800">
        <a
            href="{{ route('budgets.index') }}"
            class="w-full sm:w-auto text-center rounded-2xl border border-slate-200 dark:border-slate-700 hover:bg-slate-100 dark:hover:bg-slate-800 px-5 py-3.5 text-sm font-semibold text-slate-600 dark:text-slate-300 transition-colors ios-press"
        >
            Cancel
        </a>

        <button
            type="submit"
            class="w-full sm:w-auto rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-500 hover:from-emerald-700 hover:to-teal-600 px-6 py-3.5 text-sm font-bold text-white shadow-md shadow-emerald-500/25 transition-all ios-press flex items-center justify-center gap-2"
        >
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                <polyline points="7 3 7 8 15 8"></polyline>
            </svg>
            <span>{{ $submitLabel }}</span>
        </button>
    </div>

</div>
