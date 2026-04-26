<?php

namespace Database\Factories\RoleBasedAccess;

use App\Models\RoleBasedAccess\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class PermissionFactory extends Factory
{
    protected $model = Permission::class;

    public function definition(): array
    {
        return [
            'name'        => $this->faker->unique()->words(3, true),
            'slug'        => $this->faker->unique()->slug(2),
            'description' => $this->faker->sentence(),
            'group'       => $this->faker->randomElement(['village-banks', 'loans', 'shares', 'admin']),
        ];
    }
}
