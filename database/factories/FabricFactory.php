<?php

namespace Database\Factories;

use App\Models\Fabric;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FabricFactory extends Factory
{
    protected $model = Fabric::class;

    public function definition(): array
    {
        $addedBy = User::inRandomOrder()->first()?->id ?? 1;
        $updatedBy = User::inRandomOrder()->first()?->id ?? 1;
        $supplier = Supplier::inRandomOrder()->first()?->id ?? 1;

        return [
            'supplier_id' => $supplier,
            'fabric_no' => strtoupper(Str::random(8)),
            'composition' => $this->faker->words(3, true),
            'gsm' => $this->faker->numberBetween(100, 350),
            'qty' => $this->faker->randomFloat(2, 50, 500),
            'cuttable_width' => $this->faker->numberBetween(40, 90).' inch',
            'production_type' => $this->faker->randomElement(['Knitting', 'Weaving', 'Dyeing']),
            'construction' => $this->faker->word(),
            'color_pantone' => strtoupper(Str::random(6)),
            'weave_type' => $this->faker->randomElement(['Plain', 'Twill', 'Satin']),
            'finish_type' => $this->faker->randomElement(['Soft Finish', 'Hard Finish', 'Peach Finish']),
            'dyeing_method' => $this->faker->randomElement(['Reactive', 'Disperse', 'Vat', 'Pigment']),
            'printing_method' => $this->faker->randomElement(['Screen Print', 'Digital Print', 'Block Print']),
            'lead_time_days' => $this->faker->numberBetween(7, 60),
            'moq' => $this->faker->numberBetween(100, 1000),
            'shrinkage' => $this->faker->randomFloat(2, 0.5, 5),
            'remarks' => $this->faker->sentence(),

            'fabric_selected_by' => $this->faker->name(),
            'image_path' => 'images/fabrics/'.Str::random(10).'.jpg',
            'barcode' => strtoupper(Str::random(12)),

            'added_by' => $addedBy,
            'added_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
            'updated_by' => $updatedBy,
            'updated_date' => $this->faker->dateTimeBetween('-1 years', 'now'),
        ];
    }
}
