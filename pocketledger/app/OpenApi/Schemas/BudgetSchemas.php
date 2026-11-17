<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Budget',
    title: 'Budget',
    description: 'Monthly category budget definition',
    required: ['id', 'user_id', 'category_id', 'amount', 'budget_month'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', format: 'int64', example: 10),
        new OA\Property(property: 'user_id', type: 'integer', format: 'int64', example: 1),
        new OA\Property(property: 'category_id', type: 'integer', format: 'int64', example: 1),
        new OA\Property(property: 'amount', type: 'string', example: '5000.00', description: 'Budget limit formatted to 2 decimals'),
        new OA\Property(property: 'budget_month', type: 'string', format: 'date', example: '2026-11-01', description: 'Target month represented by the first day of the month'),
        new OA\Property(property: 'category', ref: '#/components/schemas/Category', nullable: true),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2026-11-01T00:00:00Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2026-11-01T00:00:00Z'),
    ]
)]
#[OA\Schema(
    schema: 'BudgetProgress',
    title: 'Budget Progress',
    description: 'Calculated progress and spending metrics for a category budget in a given month',
    required: ['id', 'category_id', 'amount', 'budget_month', 'spent', 'remaining', 'percentage', 'status'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', format: 'int64', example: 10),
        new OA\Property(property: 'category_id', type: 'integer', format: 'int64', example: 1),
        new OA\Property(property: 'amount', type: 'string', example: '5000.00'),
        new OA\Property(property: 'budget_month', type: 'string', format: 'date', example: '2026-11-01'),
        new OA\Property(property: 'spent', type: 'number', format: 'float', example: 3450.00, description: 'Total spent in this category for the month'),
        new OA\Property(property: 'remaining', type: 'number', format: 'float', example: 1550.00, description: 'Remaining budget amount (can be negative if exceeded)'),
        new OA\Property(property: 'percentage', type: 'number', format: 'float', example: 69.00, description: 'Percentage of budget spent'),
        new OA\Property(property: 'status', type: 'string', enum: ['normal', 'warning', 'exceeded'], example: 'normal', description: 'Progress indicator status'),
        new OA\Property(property: 'category', ref: '#/components/schemas/Category', nullable: true),
    ]
)]
#[OA\Schema(
    schema: 'StoreBudgetRequest',
    title: 'Store Budget Request Payload',
    description: 'Data payload to create a monthly category budget',
    required: ['category_id', 'amount', 'budget_month'],
    properties: [
        new OA\Property(property: 'category_id', type: 'integer', format: 'int64', description: 'ID of user active expense category', example: 1),
        new OA\Property(property: 'amount', type: 'number', format: 'float', minimum: 0.01, maximum: 9999999999999.99, example: 5000.00),
        new OA\Property(property: 'budget_month', type: 'string', example: '2026-11', description: 'Target month in YYYY-MM or YYYY-MM-DD format'),
    ]
)]
#[OA\Schema(
    schema: 'UpdateBudgetRequest',
    title: 'Update Budget Request Payload',
    description: 'Data payload to update an existing budget',
    required: ['category_id', 'amount', 'budget_month'],
    properties: [
        new OA\Property(property: 'category_id', type: 'integer', format: 'int64', description: 'ID of user active expense category', example: 1),
        new OA\Property(property: 'amount', type: 'number', format: 'float', minimum: 0.01, maximum: 9999999999999.99, example: 6000.00),
        new OA\Property(property: 'budget_month', type: 'string', example: '2026-11', description: 'Target month in YYYY-MM or YYYY-MM-DD format'),
    ]
)]
#[OA\Schema(
    schema: 'PaginatedBudgetsResponse',
    title: 'Paginated Budgets Response',
    description: 'Paginated list of budgets with pagination metadata',
    required: ['data', 'current_page', 'per_page', 'total'],
    allOf: [
        new OA\Schema(ref: '#/components/schemas/PaginationMeta'),
        new OA\Schema(
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Budget')
                ),
            ]
        ),
    ]
)]
class BudgetSchemas
{
}
