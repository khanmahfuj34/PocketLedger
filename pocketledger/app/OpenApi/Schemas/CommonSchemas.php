<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'ValidationError',
    title: 'Validation Error Response',
    description: 'Standard Laravel HTTP 422 validation failure payload',
    required: ['message', 'errors'],
    properties: [
        new OA\Property(
            property: 'message',
            type: 'string',
            description: 'Top-level validation error message',
            example: 'The given data was invalid.'
        ),
        new OA\Property(
            property: 'errors',
            type: 'object',
            description: 'Map of field names to array of specific validation error messages',
            additionalProperties: new OA\AdditionalProperties(
                type: 'array',
                items: new OA\Items(type: 'string')
            ),
            example: [
                'amount' => ['The amount field must be greater than 0.'],
                'category_id' => ['Please select one of your active expense categories.']
            ]
        ),
    ]
)]
#[OA\Schema(
    schema: 'ErrorResponse',
    title: 'Error Response',
    description: 'Standard error response payload for 400, 401, 403, 404, 429, or 500 responses',
    required: ['message'],
    properties: [
        new OA\Property(
            property: 'message',
            type: 'string',
            description: 'Human-readable error description',
            example: 'Unauthenticated.'
        ),
    ]
)]
#[OA\Schema(
    schema: 'PaginationLink',
    title: 'Pagination Link',
    description: 'Individual pagination navigation link',
    properties: [
        new OA\Property(property: 'url', type: 'string', nullable: true, example: 'http://localhost:8000/transactions?page=1'),
        new OA\Property(property: 'label', type: 'string', example: '&laquo; Previous'),
        new OA\Property(property: 'active', type: 'boolean', example: false),
        new OA\Property(property: 'page', type: 'integer', nullable: true, example: 1),
    ]
)]
#[OA\Schema(
    schema: 'PaginationMeta',
    title: 'Pagination Metadata',
    description: 'Laravel standard length-aware paginator metadata',
    required: ['current_page', 'per_page', 'total'],
    properties: [
        new OA\Property(property: 'current_page', type: 'integer', example: 1),
        new OA\Property(property: 'first_page_url', type: 'string', example: 'http://localhost:8000/transactions?page=1'),
        new OA\Property(property: 'from', type: 'integer', nullable: true, example: 1),
        new OA\Property(property: 'last_page', type: 'integer', example: 5),
        new OA\Property(property: 'last_page_url', type: 'string', example: 'http://localhost:8000/transactions?page=5'),
        new OA\Property(
            property: 'links',
            type: 'array',
            items: new OA\Items(ref: '#/components/schemas/PaginationLink')
        ),
        new OA\Property(property: 'next_page_url', type: 'string', nullable: true, example: 'http://localhost:8000/transactions?page=2'),
        new OA\Property(property: 'path', type: 'string', example: 'http://localhost:8000/transactions'),
        new OA\Property(property: 'per_page', type: 'integer', example: 10),
        new OA\Property(property: 'prev_page_url', type: 'string', nullable: true, example: null),
        new OA\Property(property: 'to', type: 'integer', nullable: true, example: 10),
        new OA\Property(property: 'total', type: 'integer', example: 48),
    ]
)]
class CommonSchemas
{
}
