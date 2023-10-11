<?php

namespace Database\Factories;

use App\Models\CusUser;
use Illuminate\Database\Eloquent\Factories\Factory;

class CusUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CusUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phonnumber' => $this->faker->phoneNumber,
            'password' => bcrypt('password1234'),
        ];
    }
}
