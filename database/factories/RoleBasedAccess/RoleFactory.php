<?php

namespace Database\Factories\RoleBasedAccess;

use App\Models\RoleBasedAccess\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->unique()->jobTitle(),
            'slug'        => $this->faker->unique()->slug(2),
            'description' => $this->faker->sentence(),
        ];
    }
}
