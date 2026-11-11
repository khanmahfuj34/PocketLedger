<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ReportController extends Controller
{
    /**
     * Display reports dashboard or return JSON data for requested period.
     */
    public function index(
        Request $request,
        ReportService $reportService
    ): View|JsonResponse {
        $validated = $request->validate([
            'type' => ['nullable', 'in:monthly,yearly,custom'],
            'month' => ['nullable', 'date_format:Y-m'],
            'year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'start_date' => ['required_if:type,custom', 'nullable', 'date_format:Y-m-d'],
            'end_date' => ['required_if:type,custom', 'nullable', 'date_format:Y-m-d', 'after_or_equal:start_date'],
        ]);

        $type = $validated['type'] ?? 'monthly';
        $user = $request->user();
        $timezone = config('app.timezone', 'Asia/Dhaka');

        $selectedMonth = null;
        $selectedYear = null;
        $startDate = null;
        $endDate = null;

        switch ($type) {
            case 'yearly':
                $selectedYear = isset($validated['year'])
                    ? (int) $validated['year']
                    : (int) CarbonImmutable::now($timezone)->year;

                $report = $reportService->getYearlyReport(
                    $user,
                    $selectedYear
                );
                break;

            case 'custom':
                $startDate = CarbonImmutable::parse(
                    $validated['start_date'],
                    $timezone
                );

                $endDate = CarbonImmutable::parse(
                    $validated['end_date'],
                    $timezone
                );

                if ($startDate->greaterThan($endDate)) {
                    throw ValidationException::withMessages([
                        'start_date' => 'Start date must be before or equal to end date.',
                    ]);
                }

                $report = $reportService->getCustomReport(
                    $user,
                    $startDate,
                    $endDate
                );
                break;

            default:
                $type = 'monthly';
                $selectedMonth = $validated['month']
                    ?? CarbonImmutable::now($timezone)->format('Y-m');

                try {
                    $month = CarbonImmutable::createFromFormat(
                        '!Y-m',
                        $selectedMonth,
                        $timezone
                    );
                } catch (\Throwable $e) {
                    $month = CarbonImmutable::now($timezone)->startOfMonth();
                    $selectedMonth = $month->format('Y-m');
                }

                $report = $reportService->getMonthlyReport(
                    $user,
                    $month
                );
                break;
        }

        $data = [
            'report' => $report,
            'reportType' => $type,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'startDate' => $startDate?->toDateString(),
            'endDate' => $endDate?->toDateString(),
        ];

        if ($request->wantsJson()) {
            return response()->json($data);
        }

        if (view()->exists('reports.index')) {
            return view('reports.index', $data);
        }

        return response()->json($data);
    }
}
