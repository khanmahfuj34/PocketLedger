<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ReportSummary',
    title: 'Report Summary',
    description: 'High-level financial KPIs for the selected reporting timeframe',
    required: ['totalIncome', 'totalExpense', 'netSavings', 'savingsRate'],
    properties: [
        new OA\Property(property: 'totalIncome', type: 'number', format: 'float', example: 85000.00),
        new OA\Property(property: 'totalExpense', type: 'number', format: 'float', example: 45000.00),
        new OA\Property(property: 'netSavings', type: 'number', format: 'float', example: 40000.00),
        new OA\Property(property: 'savingsRate', type: 'number', format: 'float', example: 47.06, description: 'Savings percentage calculated as (netSavings / totalIncome) * 100'),
    ]
)]
#[OA\Schema(
    schema: 'ReportCategoryItem',
    title: 'Report Category Item',
    description: 'Category aggregate breakdown item',
    required: ['category_id', 'category_name', 'total', 'percentage'],
    properties: [
        new OA\Property(property: 'category_id', type: 'integer', format: 'int64', example: 1),
        new OA\Property(property: 'category_name', type: 'string', example: 'Food & Dining'),
        new OA\Property(property: 'icon', type: 'string', nullable: true, example: 'utensils'),
        new OA\Property(property: 'color', type: 'string', nullable: true, example: '#EF4444'),
        new OA\Property(property: 'total', type: 'number', format: 'float', example: 12500.00),
        new OA\Property(property: 'percentage', type: 'number', format: 'float', example: 27.78),
    ]
)]
#[OA\Schema(
    schema: 'ReportTrendItem',
    title: 'Report Trend Item',
    description: 'Timeline bucket trend data point',
    required: ['period', 'income', 'expense', 'net'],
    properties: [
        new OA\Property(property: 'period', type: 'string', example: '2026-11-01', description: 'Period label or date string'),
        new OA\Property(property: 'income', type: 'number', format: 'float', example: 15000.00),
        new OA\Property(property: 'expense', type: 'number', format: 'float', example: 8500.00),
        new OA\Property(property: 'net', type: 'number', format: 'float', example: 6500.00),
    ]
)]
#[OA\Schema(
    schema: 'ReportPeriod',
    title: 'Report Period Boundaries',
    description: 'Start and end boundaries of the calculated report',
    required: ['startDate', 'endDate'],
    properties: [
        new OA\Property(property: 'startDate', type: 'string', format: 'date', example: '2026-11-01'),
        new OA\Property(property: 'endDate', type: 'string', format: 'date', example: '2026-11-30'),
    ]
)]
#[OA\Schema(
    schema: 'ReportData',
    title: 'Report Data Payload',
    description: 'Aggregated analytics payload',
    required: ['summary', 'expenseByCategory', 'incomeByCategory', 'trend', 'recentTransactions', 'period'],
    properties: [
        new OA\Property(property: 'summary', ref: '#/components/schemas/ReportSummary'),
        new OA\Property(
            property: 'expenseByCategory',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/ReportCategoryItem')
        ),
        new OA\Property(
            property: 'incomeByCategory',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/ReportCategoryItem')
        ),
        new OA\Property(
            property: 'trend',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/ReportTrendItem')
        ),
        new OA\Property(
            property: 'recentTransactions',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/Transaction')
        ),
        new OA\Property(property: 'period', ref: '#/components/schemas/ReportPeriod'),
    ]
)]
#[OA\Schema(
    schema: 'ReportResponse',
    title: 'Report Response',
    description: 'Complete JSON response payload returned by GET /reports when Accept: application/json header is provided',
    required: ['report', 'reportType'],
    properties: [
        new OA\Property(property: 'report', ref: '#/components/schemas/ReportData'),
        new OA\Property(property: 'reportType', type: 'string', enum: ['monthly', 'yearly', 'custom'], example: 'monthly'),
        new OA\Property(property: 'selectedMonth', type: 'string', nullable: true, example: '2026-11'),
        new OA\Property(property: 'selectedYear', type: 'integer', nullable: true, example: 2026),
        new OA\Property(property: 'startDate', type: 'string', format: 'date', nullable: true, example: '2026-11-01'),
        new OA\Property(property: 'endDate', type: 'string', format: 'date', nullable: true, example: '2026-11-30'),
    ]
)]
class ReportSchemas
{
}
