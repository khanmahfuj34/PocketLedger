<?php

namespace App\OpenApi;

use OpenApi\Attributes as OA;

#[OA\OpenApi(
    openapi: '3.0.0',
    info: new OA\Info(
        version: '1.0.0',
        title: 'PocketLedger API Documentation',
        description: "Production-ready API documentation for PocketLedger — Personal Expense Tracker and Budget Management System.\n\n### Authentication & Security\nPocketLedger uses Laravel's session-based cookie authentication (`cookieAuth`).\n\n**To test protected endpoints in Swagger UI:**\n1. Use the `POST /login` endpoint under **Authentication** with valid user credentials.\n2. Once authenticated, your browser will automatically preserve the `laravel_session` cookie for subsequent requests.\n3. For state-changing operations (`POST`, `PUT`, `DELETE`), pass the CSRF token in the `X-XSRF-TOKEN` header if requested.\n4. To terminate your session, execute `POST /logout`.",
        contact: new OA\Contact(
            name: 'PocketLedger Engineering Team',
            email: 'dev@pocketledger.local'
        )
    ),
    servers: [
        new OA\Server(
            url: '/',
            description: 'PocketLedger Application Base Server'
        )
    ],
    tags: [
        new OA\Tag(name: 'Authentication', description: 'User registration, login, and session management'),
        new OA\Tag(name: 'Dashboard', description: 'Financial overview, monthly KPIs, and trend metrics'),
        new OA\Tag(name: 'Transactions', description: 'Income and expense transaction tracking'),
        new OA\Tag(name: 'Budgets', description: 'Monthly category budget management and progress tracking'),
        new OA\Tag(name: 'Reports', description: 'Monthly, yearly, and custom range financial reporting and analytics'),
        new OA\Tag(name: 'Profile', description: 'User account details, name/email updates, and password security'),
        new OA\Tag(name: 'Settings', description: 'User preferences, database statistics, and financial data management'),
        new OA\Tag(name: 'Health', description: 'Application health and operational probes')
    ]
)]
#[OA\SecurityScheme(
    securityScheme: 'cookieAuth',
    type: 'apiKey',
    in: 'cookie',
    name: 'laravel_session',
    description: 'Laravel session cookie (`laravel_session`). Authenticate via `POST /login` to obtain an active session.'
)]
#[OA\SecurityScheme(
    securityScheme: 'csrfToken',
    type: 'apiKey',
    in: 'header',
    name: 'X-XSRF-TOKEN',
    description: 'CSRF token required by Laravel for state-changing HTTP methods (POST, PUT, DELETE).'
)]
#[OA\Get(
    path: '/up',
    operationId: 'healthCheck',
    summary: 'Application health probe',
    description: 'Standard Laravel health check probe used by load balancers and uptime monitoring systems.',
    tags: ['Health'],
    responses: [
        new OA\Response(
            response: 200,
            description: 'Application is operational',
            content: new OA\JsonContent(ref: '#/components/schemas/HealthStatus')
        ),
        new OA\Response(
            response: 500,
            description: 'Application unhealthy',
            content: new OA\JsonContent(ref: '#/components/schemas/ErrorResponse')
        ),
    ]
)]
class OpenApiSpec
{
}
