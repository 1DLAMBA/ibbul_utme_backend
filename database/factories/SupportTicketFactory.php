<?php

namespace Database\Factories;

use App\Models\SupportTicket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SupportTicket>
 */
class SupportTicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SupportTicket::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $topics = [
            'Payment processing issues',
            'Technical difficulties with the portal',
            'Questions about eligibility requirements',
            'Result submission problems',
            'Account access issues',
            'Other'
        ];

        $portalTypes = ['utme', 'de', 'eligibility', 'login', 'general'];
        $statuses = ['pending', 'in_progress', 'resolved', 'closed'];
        $priorities = ['low', 'medium', 'high', 'critical'];

        $topic = $this->faker->randomElement($topics);
        $details = $this->generateTopicSpecificDetails($topic);

        return [
            'topic' => $topic,
            'portal_type' => $this->faker->randomElement($portalTypes),
            'status' => $this->faker->randomElement($statuses),
            'student_name' => $this->faker->name(),
            'reg_number' => '2024/' . str_pad($this->faker->numberBetween(1, 999), 3, '0', STR_PAD_LEFT),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->email(),
            'details' => $details,
            'timestamp' => $this->faker->dateTimeBetween('-30 days', 'now'),
            
            // Admin management fields
            'admin_response' => $this->faker->optional(0.3)->paragraph(),
            'resolution_notes' => $this->faker->optional(0.2)->paragraph(),
            'assigned_to' => $this->faker->optional(0.4)->randomElement([
                'ICT Support Team',
                'Academic Office',
                'Bursary Department',
                'Portal Admin'
            ]),
            'priority' => $this->faker->optional(0.6)->randomElement($priorities),
            'estimated_resolution_time' => $this->faker->optional(0.5)->randomElement([
                '2-4 hours',
                '4-8 hours',
                '1-2 days',
                '3-5 days',
                '1 week'
            ]),
            
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }

    /**
     * Generate topic-specific details based on the selected topic.
     *
     * @param string $topic
     * @return array
     */
    private function generateTopicSpecificDetails(string $topic): array
    {
        switch ($topic) {
            case 'Payment processing issues':
                return [
                    'transactionRef' => 'PS' . $this->faker->regexify('[A-Z0-9]{10}'),
                    'paymentDate' => $this->faker->date(),
                    'amount' => '₦' . $this->faker->numberBetween(1000, 5000),
                    'description' => $this->faker->paragraph(),
                ];

            case 'Technical difficulties with the portal':
                return [
                    'browserDevice' => $this->faker->randomElement([
                        'Chrome on Windows 10',
                        'Safari on iPhone',
                        'Firefox on macOS',
                        'Edge on Windows 11'
                    ]),
                    'errorMessage' => $this->faker->optional(0.7)->sentence(),
                    'stepsToReproduce' => $this->faker->paragraph(),
                ];

            case 'Questions about eligibility requirements':
                return [
                    'question' => $this->faker->paragraph(),
                    'currentStatus' => $this->faker->randomElement([
                        'UTME candidate',
                        'DE candidate',
                        'awaiting results',
                        'completed screening'
                    ]),
                ];

            case 'Result submission problems':
                return [
                    'resultType' => $this->faker->randomElement([
                        "O'Level",
                        "A'Level",
                        'UTME',
                        'DE Results'
                    ]),
                    'issue' => $this->faker->paragraph(),
                ];

            case 'Account access issues':
                return [
                    'accessProblem' => $this->faker->randomElement([
                        "Can't login",
                        'Account locked',
                        'Wrong phone number',
                        'Password reset issues'
                    ]),
                    'lastLogin' => $this->faker->optional(0.8)->date(),
                    'additionalDetails' => $this->faker->paragraph(),
                ];

            case 'Other':
                return [
                    'issueCategory' => $this->faker->randomElement([
                        'Documentation',
                        'Course selection',
                        'Portal navigation',
                        'General inquiry'
                    ]),
                    'description' => $this->faker->paragraph(),
                    'stepsTaken' => $this->faker->paragraph(),
                ];

            default:
                return [];
        }
    }

    /**
     * Indicate that the ticket is pending.
     */
    public function pending(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'pending',
        ]);
    }

    /**
     * Indicate that the ticket is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'in_progress',
        ]);
    }

    /**
     * Indicate that the ticket is resolved.
     */
    public function resolved(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'resolved',
        ]);
    }

    /**
     * Indicate that the ticket is closed.
     */
    public function closed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'closed',
        ]);
    }

    /**
     * Indicate that the ticket is for UTME portal.
     */
    public function utme(): static
    {
        return $this->state(fn (array $attributes) => [
            'portal_type' => 'utme',
        ]);
    }

    /**
     * Indicate that the ticket is for DE portal.
     */
    public function de(): static
    {
        return $this->state(fn (array $attributes) => [
            'portal_type' => 'de',
        ]);
    }

    /**
     * Indicate that the ticket is for eligibility.
     */
    public function eligibility(): static
    {
        return $this->state(fn (array $attributes) => [
            'portal_type' => 'eligibility',
        ]);
    }

    /**
     * Indicate that the ticket has low priority.
     */
    public function lowPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'low',
        ]);
    }

    /**
     * Indicate that the ticket has medium priority.
     */
    public function mediumPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'medium',
        ]);
    }

    /**
     * Indicate that the ticket has high priority.
     */
    public function highPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'high',
        ]);
    }

    /**
     * Indicate that the ticket has critical priority.
     */
    public function criticalPriority(): static
    {
        return $this->state(fn (array $attributes) => [
            'priority' => 'critical',
        ]);
    }

    /**
     * Indicate that the ticket is assigned.
     */
    public function assigned(): static
    {
        return $this->state(fn (array $attributes) => [
            'assigned_to' => $this->faker->randomElement([
                'ICT Support Team',
                'Academic Office',
                'Bursary Department',
                'Portal Admin'
            ]),
        ]);
    }
}
