<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'HealthStatus',
    title: 'Health Status Response',
    description: 'Application operational status response from health check probe',
    properties: [
        new OA\Property(property: 'status', type: 'string', example: 'ok'),
    ]
)]
class HealthSchema
{
}
