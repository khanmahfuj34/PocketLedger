<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Carbon\CarbonImmutable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use OpenApi\Attributes as OA;

class ReportController extends Controller
{
    /**
     * Display reports dashboard or return JSON data for requested period.
     */
    #[OA\Get(
        path: '/reports',
        operationId: 'getReports',
        summary: 'Generate financial reports',
        description: 'Calculates financial reports across monthly, yearly, or custom date ranges. When the client sends the `Accept: application/json` header, returns complete JSON reporting data including summary KPIs, category expense/income breakdowns, timeline trends, and recent transactions.',
        tags: ['Reports'],
        security: [['cookieAuth' => []]],
        parameters: [
            new OA\Parameter(
                name: 'type',
                in: 'query',
                required: false,
                description: 'Report calculation type',
                schema: new OA\Schema(type: 'string', enum: ['monthly', 'yearly', 'custom'], default: 'monthly')
            ),
            new OA\Parameter(
                name: 'month',
                in: 'query',
                required: false,
                description: 'Target month in YYYY-MM format (for monthly report, defaults to current month)',
                schema: new OA\Schema(type: 'string', example: '2026-11')
            ),
            new OA\Parameter(
                name: 'year',
                in: 'query',
                required: false,
                description: 'Target year in integer format between 1900 and 2100 (for yearly report, defaults to current year)',
                schema: new OA\Schema(type: 'integer', example: 2026)
            ),
            new OA\Parameter(
                name: 'start_date',
                in: 'query',
                required: false,
                description: 'Start date in YYYY-MM-DD format (required if type=custom)',
                schema: new OA\Schema(type: 'string', format: 'date', example: '2026-11-01')
            ),
            new OA\Parameter(
                name: 'end_date',
                in: 'query',
                required: false,
                description: 'End date in YYYY-MM-DD format (required if type=custom, must be >= start_date)',
                schema: new OA\Schema(type: 'string', format: 'date', example: '2026-11-30')
            ),
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: 'Report generated successfully',
                content: new OA\JsonContent(ref: '#/components/schemas/ReportResponse')
            ),
            new OA\Response(
                response: 401,
                description: 'Unauthenticated',
                content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
            ),
            new OA\Response(
                response: 422,
                description: 'Validation error in query parameters',
                content: new OA\JsonContent(ref: '#/components/schemas/ValidationError')
            ),
        ]
    )]
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
