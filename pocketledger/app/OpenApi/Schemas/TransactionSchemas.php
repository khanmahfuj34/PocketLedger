<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Transaction',
    title: 'Transaction',
    description: 'Financial transaction entity',
    required: ['id', 'user_id', 'category_id', 'title', 'amount', 'transaction_date', 'payment_method'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', format: 'int64', example: 101),
        new OA\Property(property: 'user_id', type: 'integer', format: 'int64', example: 1),
        new OA\Property(property: 'category_id', type: 'integer', format: 'int64', example: 2),
        new OA\Property(property: 'title', type: 'string', maxLength: 150, example: 'Grocery shopping at Agora'),
        new OA\Property(property: 'amount', type: 'string', example: '1250.50', description: 'Monetary amount formatted to 2 decimals'),
        new OA\Property(property: 'transaction_date', type: 'string', format: 'date', example: '2026-11-15'),
        new OA\Property(property: 'payment_method', type: 'string', maxLength: 30, example: 'cash', description: 'Payment method (e.g. cash, bKash, card, bank)'),
        new OA\Property(property: 'note', type: 'string', nullable: true, example: 'Weekly household groceries'),
        new OA\Property(property: 'category', ref: '#/components/schemas/Category', nullable: true),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2026-11-15T09:30:00Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2026-11-15T09:30:00Z'),
        new OA\Property(property: 'deleted_at', type: 'string', format: 'date-time', nullable: true, example: null),
    ]
)]
#[OA\Schema(
    schema: 'StoreTransactionRequest',
    title: 'Store Transaction Request Payload',
    description: 'Data payload to create a new income or expense transaction',
    required: ['category_id', 'title', 'amount', 'transaction_date', 'payment_method'],
    properties: [
        new OA\Property(property: 'category_id', type: 'integer', format: 'int64', description: 'ID of user active category', example: 1),
        new OA\Property(property: 'title', type: 'string', maxLength: 150, example: 'Lunch at Cafe'),
        new OA\Property(property: 'amount', type: 'number', format: 'float', minimum: 0.01, example: 350.00),
        new OA\Property(property: 'transaction_date', type: 'string', format: 'date', example: '2026-11-15'),
        new OA\Property(property: 'payment_method', type: 'string', maxLength: 30, example: 'bKash'),
        new OA\Property(property: 'note', type: 'string', nullable: true, example: 'Team lunch'),
    ]
)]
#[OA\Schema(
    schema: 'UpdateTransactionRequest',
    title: 'Update Transaction Request Payload',
    description: 'Data payload to update an existing transaction',
    required: ['category_id', 'title', 'amount', 'transaction_date', 'payment_method'],
    properties: [
        new OA\Property(property: 'category_id', type: 'integer', format: 'int64', description: 'ID of user active category', example: 1),
        new OA\Property(property: 'title', type: 'string', maxLength: 150, example: 'Updated Lunch at Cafe'),
        new OA\Property(property: 'amount', type: 'number', format: 'float', minimum: 0.01, example: 400.00),
        new OA\Property(property: 'transaction_date', type: 'string', format: 'date', example: '2026-11-15'),
        new OA\Property(property: 'payment_method', type: 'string', maxLength: 30, example: 'cash'),
        new OA\Property(property: 'note', type: 'string', nullable: true, example: 'Updated note'),
    ]
)]
#[OA\Schema(
    schema: 'PaginatedTransactionsResponse',
    title: 'Paginated Transactions Response',
    description: 'Paginated list of transactions with pagination metadata',
    required: ['data', 'current_page', 'per_page', 'total'],
    allOf: [
        new OA\Schema(ref: '#/components/schemas/PaginationMeta'),
        new OA\Schema(
            properties: [
                new OA\Property(
                    property: 'data',
                    type: 'array',
                    items: new OA\Items(ref: '#/components/schemas/Transaction')
                ),
            ]
        ),
    ]
)]
class TransactionSchemas
{
}
