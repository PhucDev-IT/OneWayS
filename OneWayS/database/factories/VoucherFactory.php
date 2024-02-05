<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;
use Faker\Generator as Faker;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Voucher>
 */
class VoucherFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $start_time = $this->faker->dateTimeBetween('-1 week', '+1 week'); // Ngẫu nhiên ngày trong khoảng 1 tuần trước đến 1 tuần sau
        $end_time = $this->faker->dateTimeBetween($start_time, '+2 weeks'); // Ngẫu nhiên ngày trong khoảng từ start_time đến 2 tuần sau
        return [
            
        'name' => $this->faker->word,
        'description' => $this->faker->sentence,
        'discount' => $this->faker->randomFloat(2, 0, 100),
        'type' => $this->faker->randomElement(['FreeShip', 'DISCOUNTMONEY','DISCOUNTPERCENT']),
        'quantity' => $this->faker->numberBetween(1, 100),
        'used' => $this->faker->numberBetween(0, 50), // used ít hơn hoặc bằng quantity
        'status' => $this->faker->boolean,
        'start_time' => $start_time,
        'end_time' => $end_time,
        ];
    }
}
