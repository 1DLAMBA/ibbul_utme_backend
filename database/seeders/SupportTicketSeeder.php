<?php

namespace Database\Seeders;

use App\Models\SupportTicket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 20 support tickets with varied data
        SupportTicket::factory(20)->create();

        // Create some specific status-based tickets for testing
        SupportTicket::factory(5)->pending()->create();
        SupportTicket::factory(3)->inProgress()->create();
        SupportTicket::factory(8)->resolved()->create();
        SupportTicket::factory(4)->closed()->create();

        // Create some portal-specific tickets
        SupportTicket::factory(6)->utme()->create();
        SupportTicket::factory(4)->de()->create();
        SupportTicket::factory(5)->eligibility()->create();

        // Create some priority-based tickets
        SupportTicket::factory(8)->lowPriority()->create();
        SupportTicket::factory(6)->mediumPriority()->create();
        SupportTicket::factory(4)->highPriority()->create();
        SupportTicket::factory(2)->criticalPriority()->create();

        // Create some assigned tickets
        SupportTicket::factory(10)->assigned()->create();

        $this->command->info('Support tickets seeded successfully!');
        $this->command->info('Total tickets created: ' . SupportTicket::count());
    }
}
