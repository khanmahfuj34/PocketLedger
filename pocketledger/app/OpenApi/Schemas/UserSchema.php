<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'User',
    title: 'User',
    description: 'PocketLedger authenticated user model',
    required: ['id', 'name', 'email'],
    properties: [
        new OA\Property(property: 'id', type: 'integer', format: 'int64', example: 1),
        new OA\Property(property: 'name', type: 'string', maxLength: 255, example: 'John Doe'),
        new OA\Property(property: 'email', type: 'string', format: 'email', maxLength: 255, example: 'john@example.com'),
        new OA\Property(property: 'created_at', type: 'string', format: 'date-time', example: '2026-11-10T07:22:15Z'),
        new OA\Property(property: 'updated_at', type: 'string', format: 'date-time', example: '2026-11-10T07:22:15Z'),
    ]
)]
class UserSchema
{
}
