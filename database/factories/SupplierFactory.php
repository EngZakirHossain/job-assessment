<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SupplierFactory extends Factory
{
    protected $model = Supplier::class;

    public function definition(): array
    {

        $addedBy = User::inRandomOrder()->first()?->id ?? 1;
        $updatedBy = User::inRandomOrder()->first()?->id ?? 1;

        return [
            'country' => $this->faker->country(),
            'company_name' => $this->faker->company(),
            'code' => strtoupper(Str::random(6)),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),

            'rep_name' => $this->faker->name(),
            'rep_email' => $this->faker->unique()->safeEmail(),
            'rep_phone' => $this->faker->phoneNumber(),

            'added_by' => $addedBy,
            'added_date' => Carbon::now(),
            'updated_by' => $updatedBy,
            'updated_date' => Carbon::now(),
        ];
    }
}
