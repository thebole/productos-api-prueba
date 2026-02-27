<?php

namespace Tests\Feature;

use App\Models\Api\Currency\Divisas;
use App\Models\Api\Detail\ProductPrice;
use App\Models\Api\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Tests\TestCase;

class ProductPriceControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $adminUser;
    private User $viewerUser;
    private User $unauthorizedUser;
    private Divisas $divisa;
    private Product $product;

    protected function setUp(): void
    {
        parent::setUp();

        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'products.view',
            'products.view.price',
            'products.create',
            'products.update',
            'products.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $viewerRole = Role::firstOrCreate(['name' => 'viewer', 'guard_name' => 'web']);

        $adminRole->syncPermissions($permissions);
        $viewerRole->syncPermissions(['products.view', 'products.view.price']);

        $this->adminUser = User::factory()->create();
        $this->adminUser->assignRole($adminRole);

        $this->viewerUser = User::factory()->create();
        $this->viewerUser->assignRole($viewerRole);

        $this->unauthorizedUser = User::factory()->create();

        $this->divisa = Divisas::create([
            'name' => 'Dolar',
            'symbol' => '$',
            'exchange_rate' => 1,
        ]);

        $this->product = Product::create([
            'name' => 'Test Product',
            'description' => 'Test Description',
            'price' => 100.00,
            'divisa_id' => $this->divisa->id,
        ]);
    }

    // ==================== INDEX (List Prices) ====================

    public function test_index_returns_paginated_prices_for_product(): void
    {
        ProductPrice::create([
            'product_id' => $this->product->id,
            'price' => 50.00,
            'divisa_id' => $this->divisa->id,
        ]);

        ProductPrice::create([
            'product_id' => $this->product->id,
            'price' => 75.00,
            'divisa_id' => $this->divisa->id,
        ]);

        $response = $this->actingAs($this->adminUser)
            ->getJson("/api/products/{$this->product->id}/prices?page=1&per_page=15");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'prices' => [
                    'data',
                    'current_page',
                    'last_page',
                    'per_page',
                    'total',
                ],
            ]);

        $this->assertCount(2, $response->json('prices.data'));
    }

    public function test_index_returns_empty_for_product_with_no_prices(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->getJson("/api/products/{$this->product->id}/prices");

        $response->assertStatus(200);
        $this->assertCount(0, $response->json('prices.data'));
    }

    public function test_index_forbidden_without_view_price_permission(): void
    {
        $response = $this->actingAs($this->unauthorizedUser)
            ->getJson("/api/products/{$this->product->id}/prices");

        $response->assertStatus(403);
    }

    public function test_index_requires_authentication(): void
    {
        $response = $this->getJson("/api/products/{$this->product->id}/prices");

        $response->assertStatus(401);
    }

    // ==================== STORE (Create Price) ====================

    public function test_store_creates_price_for_product(): void
    {
        $payload = [
            'price' => 120.50,
            'divisa_id' => $this->divisa->id,
        ];

        $response = $this->actingAs($this->adminUser)
            ->postJson("/api/products/{$this->product->id}/prices", $payload);

        $response->assertStatus(201)
            ->assertJsonPath('message', 'Product price created successfully.')
            ->assertJsonStructure(['price' => ['id', 'product_id', 'price', 'divisa_id']]);

        $this->assertDatabaseHas('products_prices', [
            'product_id' => $this->product->id,
            'divisa_id' => $this->divisa->id,
        ]);
    }

    public function test_store_validation_fails_with_missing_fields(): void
    {
        $response = $this->actingAs($this->adminUser)
            ->postJson("/api/products/{$this->product->id}/prices", []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['price', 'divisa_id']);
    }

    public function test_store_validation_fails_with_invalid_divisa(): void
    {
        $payload = [
            'price' => 100.00,
            'divisa_id' => 999,
        ];

        $response = $this->actingAs($this->adminUser)
            ->postJson("/api/products/{$this->product->id}/prices", $payload);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['divisa_id']);
    }

    public function test_store_forbidden_without_create_permission(): void
    {
        $payload = [
            'price' => 100.00,
            'divisa_id' => $this->divisa->id,
        ];

        $response = $this->actingAs($this->viewerUser)
            ->postJson("/api/products/{$this->product->id}/prices", $payload);

        $response->assertStatus(403);
    }
}
