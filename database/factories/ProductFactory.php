<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name= $this->faker->words(5, true);
        return [
            "name"=> $name,
            "slug"=> Str::slug($name),
            "price"=> $this->faker->randomFloat(2,0,2000),
            "description"=> $this->faker->sentence(15),
            "image"=> $this->faker->imageUrl(),
            "Compare_Price"=>$this->faker->randomFloat(2,500,2000),
            "category_id"=>Category::inRandomOrder()->first()->id,
            "store_id"=> Store::inRandomOrder()->first()->id,
            "feature"=>rand(0,1)
        ];
    }
}
