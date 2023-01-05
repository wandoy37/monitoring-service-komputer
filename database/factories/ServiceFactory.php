<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;
use Nette\Utils\Random;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $lastService = Service::all()->count();
        $lastService++;
        return [
            'code_service' => 'SRV-' . date('Ymd') . '-' . random_int(1000, 9999),
            'status_service' => $this->faker->randomElement(['registration', 'check', 'repair', 'cancle']),
            'customer_name' => $this->faker->name(),
            'customer_phone' => random_int(1000, 9999),
            'device' => 'Laptop unknow',
            'keluhan' => 'Keluhan unknow',
            'store' => $this->faker->randomElement(['Ghuftha - Perjuangan', 'Ghuftha - Pelita']),
            'created_at' => 2022 . '-' . random_int(1, 12) . '-' . random_int(01, 28) . ' ' . '00:00:00'
            // 2023-01-01 14:13:39
        ];
    }
}
