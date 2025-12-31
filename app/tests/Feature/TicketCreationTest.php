<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketCreationTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_can_be_created(): void
    {
        $response = $this->postJson('/api/tickets', [
            'name' => 'John Doe11111featuretest',
            'email' => 'john@test.com',
            'phone' => '+49123456789',
            'subject' => 'Feature Test subject',
            'message' => 'Test message',
        ]);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tickets', [
            'subject' => 'Feature Test subject',
        ]);
    }
}

