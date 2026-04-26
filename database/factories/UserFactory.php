<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name'              => $this->faker->name(),
            'username'          => $this->faker->unique()->userName(),
            'email'             => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token'    => Str::random(10),
            'job_title'         => $this->faker->jobTitle(),
            'user_unit'         => $this->faker->word(),
            'directorate'       => $this->faker->word(),
            'user_role_id'      => 2,
            'usertype'          => 0,
            'mobile_no'         => $this->faker->phoneNumber(),
            'status'            => 'active',
            'uuid'              => (string) Str::uuid(),
            'password_changed'  => true,
        ];
    }

    public function unverified(): static
    {
        return $this->state(['email_verified_at' => null]);
    }

    public function superAdmin(): static
    {
        return $this->state(['user_role_id' => 1]);
    }
}
