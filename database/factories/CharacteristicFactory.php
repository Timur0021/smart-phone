<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Products\Models\Characteristic;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CharacteristicFactory extends Factory
{
    protected $model = Characteristic::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $characteristics = [
            'Бренд',
            'Памʼять',
            'Колір',
            'Екран',
            'Процесор',
            'Батарея',
            'Камера',
            'Операційна система',
            'Тип підключення',
            'Матеріал корпусу',
            'Вага',
            'Гарантія',
            'Роздільна здатність',
            'Частота оновлення',
            'Тип навушників',
        ];

        return [
            'name' => [
                'uk' => $this->faker->randomElement($characteristics),
                'en' => $this->faker->randomElement([
                    'Brand',
                    'Memory',
                    'Color',
                    'Display',
                    'Processor',
                    'Battery',
                    'Camera',
                    'OS',
                    'Connection Type',
                    'Body Material',
                    'Weight',
                    'Warranty',
                    'Resolution',
                    'Refresh Rate',
                    'Headphone Type',
                ]),
            ],
            'slug' => null,
            'sort_order' => $this->faker->numberBetween(1, 100),
            'active' => $this->faker->boolean(90),
            'show_in_filter' => $this->faker->boolean(70),
            'show_in_product' => $this->faker->boolean(90),
        ];
    }
}
