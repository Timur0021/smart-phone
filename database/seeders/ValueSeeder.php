<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Products\Models\Characteristic;
use Modules\Products\Models\Value;

class ValueSeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            'Бренд' => [
                ['uk' => 'Apple', 'en' => 'Apple'],
                ['uk' => 'Samsung', 'en' => 'Samsung'],
                ['uk' => 'Xiaomi', 'en' => 'Xiaomi'],
                ['uk' => 'Huawei', 'en' => 'Huawei'],
                ['uk' => 'Sony', 'en' => 'Sony'],
                ['uk' => 'Dell', 'en' => 'Dell'],
                ['uk' => 'HP', 'en' => 'HP'],
                ['uk' => 'Lenovo', 'en' => 'Lenovo'],
                ['uk' => 'Asus', 'en' => 'Asus'],
                ['uk' => 'Acer', 'en' => 'Acer'],
            ],

            'Памʼять' => [
                ['uk' => '32GB', 'en' => '32GB'],
                ['uk' => '64GB', 'en' => '64GB'],
                ['uk' => '128GB', 'en' => '128GB'],
                ['uk' => '256GB', 'en' => '256GB'],
                ['uk' => '512GB', 'en' => '512GB'],
                ['uk' => '1TB', 'en' => '1TB'],
            ],

            'Колір' => [
                ['uk' => 'Чорний', 'en' => 'Black'],
                ['uk' => 'Білий', 'en' => 'White'],
                ['uk' => 'Синій', 'en' => 'Blue'],
                ['uk' => 'Червоний', 'en' => 'Red'],
                ['uk' => 'Зелений', 'en' => 'Green'],
                ['uk' => 'Сірий', 'en' => 'Gray'],
                ['uk' => 'Золотий', 'en' => 'Gold'],
            ],

            'Екран' => [
                ['uk' => '5.5"', 'en' => '5.5 inch'],
                ['uk' => '6.1"', 'en' => '6.1 inch'],
                ['uk' => '6.5"', 'en' => '6.5 inch'],
                ['uk' => '6.7"', 'en' => '6.7 inch'],
                ['uk' => '14"', 'en' => '14 inch'],
                ['uk' => '15.6"', 'en' => '15.6 inch'],
                ['uk' => '17"', 'en' => '17 inch'],
            ],

            'Процесор' => [
                ['uk' => 'A17 Bionic', 'en' => 'A17 Bionic'],
                ['uk' => 'Snapdragon 8 Gen 3', 'en' => 'Snapdragon 8 Gen 3'],
                ['uk' => 'Intel i5', 'en' => 'Intel Core i5'],
                ['uk' => 'Intel i7', 'en' => 'Intel Core i7'],
                ['uk' => 'M2', 'en' => 'Apple M2'],
            ],

            'Батарея' => [
                ['uk' => '3000 mAh', 'en' => '3000 mAh'],
                ['uk' => '4000 mAh', 'en' => '4000 mAh'],
                ['uk' => '5000 mAh', 'en' => '5000 mAh'],
                ['uk' => '6000 mAh', 'en' => '6000 mAh'],
            ],
        ];

        $characteristics = Characteristic::all()->keyBy('name');

        foreach ($map as $characteristicName => $values) {

            $characteristic = $characteristics[$characteristicName] ?? null;

            if (!$characteristic) {
                continue;
            }

            foreach ($values as $value) {
                Value::query()
                    ->create([
                        'characteristic_id' => $characteristic->id,
                        'name' => $value,
                        'sort_order' => rand(1, 100),
                        'active' => true,
                    ]);
            }
        }
    }
}
