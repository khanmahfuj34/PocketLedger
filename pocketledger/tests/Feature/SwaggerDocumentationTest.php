<?php

namespace Tests\Feature;

use Tests\TestCase;

class SwaggerDocumentationTest extends TestCase
{
    /**
     * Test that Swagger UI interface endpoint loads successfully.
     */
    public function test_swagger_ui_interface_is_accessible(): void
    {
        $response = $this->get('/api/documentation');

        $response->assertStatus(200);
        $response->assertSee('PocketLedger API Documentation');
    }

    /**
     * Test that OpenAPI JSON specification is accessible and valid.
     */
    public function test_openapi_json_specification_is_valid(): void
    {
        $response = $this->get('/docs/api-docs.json');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/json');

        $data = $response->json();

        $this->assertEquals('3.0.0', $data['openapi']);
        $this->assertEquals('PocketLedger API Documentation', $data['info']['title']);
        $this->assertNotEmpty($data['info']['version']);

        // Check required security schemes
        $this->assertArrayHasKey('cookieAuth', $data['components']['securitySchemes']);
        $this->assertArrayHasKey('csrfToken', $data['components']['securitySchemes']);

        // Check key API paths exist
        $paths = $data['paths'];
        $this->assertArrayHasKey('/login', $paths);
        $this->assertArrayHasKey('/register', $paths);
        $this->assertArrayHasKey('/logout', $paths);
        $this->assertArrayHasKey('/dashboard', $paths);
        $this->assertArrayHasKey('/transactions', $paths);
        $this->assertArrayHasKey('/transactions/{id}', $paths);
        $this->assertArrayHasKey('/budgets', $paths);
        $this->assertArrayHasKey('/budgets/{budget}', $paths);
        $this->assertArrayHasKey('/reports', $paths);
        $this->assertArrayHasKey('/profile', $paths);
        $this->assertArrayHasKey('/profile/password', $paths);
        $this->assertArrayHasKey('/settings', $paths);
        $this->assertArrayHasKey('/settings/clear-data', $paths);
        $this->assertArrayHasKey('/up', $paths);

        // Check reusable schemas exist
        $schemas = $data['components']['schemas'];
        $this->assertArrayHasKey('User', $schemas);
        $this->assertArrayHasKey('Category', $schemas);
        $this->assertArrayHasKey('Transaction', $schemas);
        $this->assertArrayHasKey('Budget', $schemas);
        $this->assertArrayHasKey('BudgetProgress', $schemas);
        $this->assertArrayHasKey('ReportResponse', $schemas);
        $this->assertArrayHasKey('ValidationError', $schemas);
        $this->assertArrayHasKey('ErrorResponse', $schemas);
        $this->assertArrayHasKey('PaginationMeta', $schemas);
    }

    /**
     * Test that OpenAPI YAML specification is also accessible when configured.
     */
    public function test_openapi_yaml_specification_is_accessible(): void
    {
        $response = $this->get('/docs/api-docs.yaml');

        $response->assertStatus(200);
    }
}
