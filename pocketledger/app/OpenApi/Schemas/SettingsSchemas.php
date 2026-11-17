<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'SettingsStats',
    title: 'Settings Data Statistics',
    description: 'Summary counts of data entities stored in user account',
    required: ['transactionsCount', 'budgetsCount', 'attachmentsCount'],
    properties: [
        new OA\Property(property: 'transactionsCount', type: 'integer', example: 120),
        new OA\Property(property: 'budgetsCount', type: 'integer', example: 12),
        new OA\Property(property: 'attachmentsCount', type: 'integer', example: 4),
    ]
)]
#[OA\Schema(
    schema: 'ClearDataRequest',
    title: 'Clear Data Request Payload',
    description: 'Payload to irrevocably delete all financial transactions, budgets, and attachments for user account',
    required: ['password', 'confirmation'],
    properties: [
        new OA\Property(property: 'password', type: 'string', format: 'password', description: 'Account password to verify identity', example: 'secret1234'),
        new OA\Property(property: 'confirmation', type: 'string', description: 'Exact string "CLEAR" required to prevent accidental execution', example: 'CLEAR'),
    ]
)]
class SettingsSchemas
{
}
