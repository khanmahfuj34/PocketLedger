<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ProfileStats',
    title: 'Profile Statistics',
    description: 'Summary counts displayed on user profile',
    required: ['transactionsCount', 'budgetsCount', 'categoriesCount', 'memberSince'],
    properties: [
        new OA\Property(property: 'transactionsCount', type: 'integer', example: 45),
        new OA\Property(property: 'budgetsCount', type: 'integer', example: 8),
        new OA\Property(property: 'categoriesCount', type: 'integer', example: 15),
        new OA\Property(property: 'memberSince', type: 'string', example: 'Nov 10, 2026'),
    ]
)]
#[OA\Schema(
    schema: 'UpdateProfileRequest',
    title: 'Update Profile Request Payload',
    description: 'Data payload to update account name and email',
    required: ['name', 'email'],
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, example: 'John Doe'),
        new OA\Property(property: 'email', type: 'string', format: 'email', maxLength: 255, example: 'john.doe@example.com'),
    ]
)]
#[OA\Schema(
    schema: 'UpdatePasswordRequest',
    title: 'Update Password Request Payload',
    description: 'Data payload to update account password',
    required: ['current_password', 'password', 'password_confirmation'],
    properties: [
        new OA\Property(property: 'current_password', type: 'string', format: 'password', example: 'old_secret1234'),
        new OA\Property(property: 'password', type: 'string', format: 'password', minLength: 8, example: 'new_secret5678'),
        new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', minLength: 8, example: 'new_secret5678'),
    ]
)]
class ProfileSchemas
{
}
