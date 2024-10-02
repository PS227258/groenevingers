<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ViewTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        $this->artisan('migrate:fresh --seed');
    }

    /**
     * test that a view can be rendered with it's coresponding endpoint
     */
    public function test_that_views_can_be_rendered(): void
    {
        // Arange
        $endpoints = [
            '/' => 'home',
            '/shop' => 'shop.index',
            '/contact' => 'contact',
        ];

        foreach ($endpoints as $endpoint => $view) {
            // Act
            $response = $this->get($endpoint);

            // Assert
            $response->assertStatus(200);
            $response->assertViewIs($view);
        }
    }

    public function test_that_views_get_their_parameters(): void
    {
        // Arange
        $endpoints = [
            '/' => 'products',
        ];

        foreach ($endpoints as $endpoint => $view) {
            // Act
            $response = $this->get($endpoint);

            // Assert
            $response->assertViewHas($view);
        }
    }
}
