<?php

namespace Database\Factories;

use App\Models\UnitEloquent;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UnitEloquentFactory extends Factory
{
    protected $model = UnitEloquent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => Str::random(10)
        ];
    }
}