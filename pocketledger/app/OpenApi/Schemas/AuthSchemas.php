<?php

namespace App\OpenApi\Schemas;

use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'RegisterRequest',
    title: 'Register Request Payload',
    description: 'User registration credentials',
    required: ['name', 'email', 'password', 'password_confirmation'],
    properties: [
        new OA\Property(property: 'name', type: 'string', maxLength: 255, example: 'John Doe'),
        new OA\Property(property: 'email', type: 'string', format: 'email', maxLength: 255, example: 'john@example.com'),
        new OA\Property(property: 'password', type: 'string', format: 'password', minLength: 8, example: 'secret1234'),
        new OA\Property(property: 'password_confirmation', type: 'string', format: 'password', minLength: 8, example: 'secret1234'),
    ]
)]
#[OA\Schema(
    schema: 'LoginRequest',
    title: 'Login Request Payload',
    description: 'User session authentication credentials',
    required: ['email', 'password'],
    properties: [
        new OA\Property(property: 'email', type: 'string', format: 'email', example: 'john@example.com'),
        new OA\Property(property: 'password', type: 'string', format: 'password', example: 'secret1234'),
    ]
)]
class AuthSchemas
{
}
