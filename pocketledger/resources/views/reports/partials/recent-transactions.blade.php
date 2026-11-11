<!-- Recent Transactions Table / List -->
@php
    $recent = $report['recentTransactions'] ?? collect();
@endphp

<div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-3xl p-4.5 sm:p-6 shadow-xs hover:shadow-md transition-all">
    <div class="flex items-center justify-between mb-5">
        <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-xl bg-violet-50 dark:bg-violet-950/60 text-violet-600 dark:text-violet-400 flex items-center justify-center shrink-0">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="17 1 21 5 17 9"></polyline>
                    <path d="M3 11V9a4 4 0 0 1 4-4h14"></path>
                    <polyline points="7 23 3 19 7 15"></polyline>
                    <path d="M21 13v2a4 4 0 0 1-4 4H3"></path>
                </svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-900 dark:text-white">Recent Transactions</h2>
                <p class="text-[11px] text-slate-400 dark:text-slate-500 font-medium">Activity recorded within this reporting window</p>
            </div>
        </div>

        <a href="{{ route('transactions.index') }}" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 inline-flex items-center gap-1 transition-colors ios-press">
            <span>View All</span>
            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </a>
    </div>

    @if ($recent->isEmpty())
        <div class="py-10 text-center">
            <p class="text-xs sm:text-sm font-semibold text-slate-400 dark:text-slate-500">No transactions recorded for this period.</p>
            <a href="{{ route('transactions.create') }}" class="inline-flex items-center gap-1.5 text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 mt-2 transition-colors ios-press">
                + Add Transaction
            </a>
        </div>
    @else
        <!-- Desktop Table (hidden on mobile) -->
        <div class="hidden sm:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-slate-100 dark:border-slate-800 text-[11px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">
                        <th class="py-3 px-3">Title & Category</th>
                        <th class="py-3 px-3">Date</th>
                        <th class="py-3 px-3">Method</th>
                        <th class="py-3 px-3 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 dark:divide-slate-800/80">
                    @foreach ($recent as $tx)
                        @php
                            $isIncome = ($tx->category?->type === 'income');
                        @endphp
                        <tr class="hover:bg-slate-50/80 dark:hover:bg-slate-800/40 transition-colors">
                            <td class="py-3.5 px-3">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0" style="background-color: {{ $tx->category?->color ? $tx->category->color . '20' : '#10B98120' }}; color: {{ $tx->category?->color ?? '#10B981' }}">
                                        @if ($isIncome)
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                                <line x1="12" y1="19" x2="12" y2="5"></line>
                                                <polyline points="5 12 12 5 19 12"></polyline>
                                            </svg>
                                        @else
                                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                                <polyline points="19 12 12 19 5 12"></polyline>
                                            </svg>
                                        @endif
                                    </div>
                                    <div class="min-w-0">
                                        <p class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ $tx->title }}</p>
                                        <p class="text-[10px] font-semibold text-slate-400 dark:text-slate-500">{{ $tx->category?->name ?? 'General' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-xs text-slate-600 dark:text-slate-300 font-medium">
                                {{ $tx->transaction_date ? \Carbon\Carbon::parse($tx->transaction_date)->format('M d, Y') : '-' }}
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap">
                                <span class="text-[10px] font-bold text-slate-500 dark:text-slate-400 bg-slate-100 dark:bg-slate-800 px-2 py-0.5 rounded-lg capitalize">
                                    {{ str_replace('_', ' ', $tx->payment_method ?? 'cash') }}
                                </span>
                            </td>
                            <td class="py-3.5 px-3 whitespace-nowrap text-right font-black text-xs sm:text-sm {{ $isIncome ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                {{ $isIncome ? '+' : '-' }}৳ {{ number_format((float) $tx->amount, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Mobile Card List (visible on sm:hidden) -->
        <div class="sm:hidden space-y-2.5">
            @foreach ($recent as $tx)
                @php
                    $isIncome = ($tx->category?->type === 'income');
                @endphp
                <div class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-800/60 border border-slate-100 dark:border-slate-700/60 flex items-center justify-between">
                    <div class="flex items-center gap-2.5 min-w-0">
                        <div class="w-8 h-8 rounded-xl flex items-center justify-center shrink-0" style="background-color: {{ $tx->category?->color ? $tx->category->color . '20' : '#10B98120' }}; color: {{ $tx->category?->color ?? '#10B981' }}">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3">
                                <circle cx="12" cy="12" r="9"></circle>
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <p class="text-xs font-bold text-slate-900 dark:text-white truncate">{{ $tx->title }}</p>
                            <p class="text-[10px] text-slate-400 dark:text-slate-500">
                                {{ $tx->transaction_date ? \Carbon\Carbon::parse($tx->transaction_date)->format('M d') : '' }} • {{ $tx->category?->name ?? 'General' }}
                            </p>
                        </div>
                    </div>

                    <div class="text-right shrink-0">
                        <p class="text-xs font-black {{ $isIncome ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                            {{ $isIncome ? '+' : '-' }}৳ {{ number_format((float) $tx->amount, 2) }}
                        </p>
                        <p class="text-[9px] font-semibold text-slate-400 capitalize">{{ str_replace('_', ' ', $tx->payment_method ?? 'cash') }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

