<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'firstname' => 'Admin',
            'lastname' => 'One',
            'staff_id' => '0000001',
            'email' => $this->faker->unique()->safeEmail(),
            'profile_picture' => 'none',
            'department' => 'Computer science',
            'date_of_birth' => '2022-03-09',
            'phone_number' => '09078810948',
            'ticket_permission' => false,
            'is_admin' => true,
            'gender' => 'Male',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
