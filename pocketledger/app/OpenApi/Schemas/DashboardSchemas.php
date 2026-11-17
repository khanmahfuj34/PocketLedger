<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'DashboardMetrics',
    title: 'Dashboard Financial Metrics',
    description: 'Summary financial figures and KPI indicators for the active dashboard month',
    required: ['monthlyIncome', 'monthlyExpense', 'netSavings', 'savingsRate', 'monthlyBudget', 'budgetRemaining', 'budgetProgress', 'selectedMonth'],
    properties: [
        new OA\Property(property: 'monthlyIncome', type: 'number', format: 'float', example: 75000.00),
        new OA\Property(property: 'monthlyExpense', type: 'number', format: 'float', example: 42000.00),
        new OA\Property(property: 'netSavings', type: 'number', format: 'float', example: 33000.00),
        new OA\Property(property: 'savingsRate', type: 'number', format: 'float', example: 44.0, description: 'Savings rate percentage'),
        new OA\Property(property: 'monthlyBudget', type: 'number', format: 'float', example: 50000.00),
        new OA\Property(property: 'budgetRemaining', type: 'number', format: 'float', example: 8000.00),
        new OA\Property(property: 'budgetProgress', type: 'number', format: 'float', example: 84.0, description: 'Percentage of total monthly budget consumed'),
        new OA\Property(property: 'selectedMonth', type: 'string', example: '2026-11'),
    ]
)]
class DashboardSchemas
{
}
