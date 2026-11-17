<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'Category',
    title: 'Category',
    description: 'Transaction category entity belonging to the user',
    required: ['id', 'user_id', 'name', 'type', 'is_active'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', format: 'int64', example: 1),
        new OA\Property(property: 'user_id', type: 'integer', format: 'int64', example: 1),
        new OA\Property(property: 'name', type: 'string', maxLength: 100, example: 'Food & Dining'),
        new OA\Property(property: 'type', type: 'string', enum: ['income', 'expense'], example: 'expense'),
        new OA\Property(property: 'icon', type: 'string', maxLength: 50, nullable: true, example: 'utensils'),
        new OA\Property(property: 'color', type: 'string', maxLength: 20, nullable: true, example: '#EF4444'),
        new OA\Property(property: 'is_active', type: 'boolean', example: true),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2026-11-10T07:22:15Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2026-11-10T07:22:15Z'),
    ]
)]
class CategorySchemas
{
}
