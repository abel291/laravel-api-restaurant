<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DiscountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' =>$this->faker->bothify('?#?#?#?#') ,
            'percent' =>rand(1,100),
            'quantity' =>rand(1,100) ,
            'active' =>1 ,
        ];
    }
}
