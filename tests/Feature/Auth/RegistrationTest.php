<?php

namespace Tests\Feature\Auth;

use App\Models\Branch;
use App\Models\Role;
use App\Models\UserStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Role::factory()->create(['name' => 'Admin']);
        Branch::factory()->create(['name' => 'Nuenen']);
        UserStatus::factory()->create(['name' => 'Active']);
    }

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }
}
