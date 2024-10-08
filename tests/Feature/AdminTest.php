<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Admin;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_admins()
    {
        // Membuat satu data admin menggunakan factory
        $admin = Admin::factory()->create();

        // Mengecek apakah data admin dibuat di database
        $this->assertDatabaseHas('admins', [
            'id' => $admin->id
        ]);
    }
}
