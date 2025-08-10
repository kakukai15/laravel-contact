<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    public function definition(): array
    {
        return [
            'last_name'    => $this->faker->lastName,
            'first_name'   => $this->faker->firstName,
            'email'        => $this->faker->safeEmail,
            'gender' => $this->faker->randomElement(['男性', '女性', 'その他']),
            'tel'          => $this->faker->numerify('0##########'),
            'address'      => $this->faker->address,
            'building'     => $this->faker->secondaryAddress,
            'category_id'  => $this->faker->numberBetween(1, 5),
            'message'      => $this->faker->realText(100),
            //'body' => $this->faker->realText(100),
        ];
    }
}

