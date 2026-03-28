<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Products\Models\Category;
use Exception;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Смартфони та телефони' => [
                'Смартфони',
                'Кнопкові телефони',
                'Аксесуари для телефонів',
            ],
            'Ноутбуки та комп’ютери' => [
                'Ноутбуки',
                'Планшети',
                'Моноблоки',
                'Комплектуючі ПК',
            ],
            'Аудіо техніка' => [
                'Навушники',
                'Колонки',
                'Підсилювачі',
            ],
            'Фото та відео' => [
                'Фотоапарати',
                'Об’єктиви',
                'Екшн-камери',
                'Квадрокоптери',
            ],
            'ТБ та мультимедіа' => [
                'Телевізори',
                'Smart TV приставки',
                'Проектори',
            ],
            'Гаджети' => [
                'Смарт-годинники',
                'Фітнес-браслети',
                'VR окуляри',
            ],
            'Мережеве обладнання' => [
                'Роутери',
                'Модеми',
                'Mesh системи',
            ],
            'Аксесуари' => [
                'Зарядні пристрої',
                'Кабелі',
                'Power Bank',
                'Чохли',
            ],
        ];

        $sort = 1;

        foreach ($categories as $parentName => $children) {
            $parent = Category::query()
                ->updateOrCreate(
                    [
                        'slug' => Str::slug($parentName)
                    ],
                    [
                        'name' => [
                            'uk' => $parentName,
                            'en' => $parentName,
                        ],
                        'parent_id' => null,
                        'sort_order' => $sort++,
                        'active' => true,
                        'will_be_soon' => false,
                    ]
                );

            $this->addImage($parent, $parentName);

            $childSort = 1;

            foreach ($children as $childName) {
                $child = Category::query()
                    ->updateOrCreate(
                        [
                            'slug' => Str::slug($childName)
                        ],
                        [
                            'name' => [
                                'uk' => $childName,
                                'en' => $childName,
                            ],
                            'parent_id' => $parent->id,
                            'sort_order' => $childSort++,
                            'active' => true,
                            'will_be_soon' => false,
                        ]
                    );

                $this->addImage($child, $childName);
            }
        }
    }

    private function addImage(Category $category, string $name): void
    {
        if ($category->hasMedia('image')) {
            return;
        }

        try {
            $url = $this->getImageByCategory($name);

            $category
                ->addMediaFromUrl($url)
                ->usingFileName($category->slug . '.jpg')
                ->toMediaCollection('image');

        } catch (Exception $e) {
            Log::error('Category image error', [
                'category' => $category->slug,
                'error' => $e->getMessage(),
            ]);
        }
    }

    private function getImageByCategory(string $name): string
    {
        $base = '?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop';

        return match ($name) {
            'Смартфони та телефони' => "https://images.pexels.com/photos/607812/pexels-photo-607812.jpeg{$base}",
            'Смартфони' => "https://images.pexels.com/photos/404280/pexels-photo-404280.jpeg{$base}",
            'Кнопкові телефони' => "https://images.pexels.com/photos/47261/pexels-photo-47261.jpeg{$base}",
            'Аксесуари для телефонів' => "https://images.pexels.com/photos/163143/pexels-photo-163143.jpeg{$base}",

            'Ноутбуки та комп’ютери' => "https://images.pexels.com/photos/18105/pexels-photo.jpg{$base}",
            'Ноутбуки' => "https://images.pexels.com/photos/18105/pexels-photo.jpg{$base}",
            'Планшети' => "https://images.pexels.com/photos/5082563/pexels-photo-5082563.jpeg{$base}",
            'Моноблоки' => "https://images.pexels.com/photos/577210/pexels-photo-577210.jpeg{$base}",
            'Комплектуючі ПК' => "https://images.pexels.com/photos/2582937/pexels-photo-2582937.jpeg{$base}",

            'Аудіо техніка' => "https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg{$base}",
            'Навушники' => "https://images.pexels.com/photos/3394650/pexels-photo-3394650.jpeg{$base}",
            'Колонки' => "https://images.pexels.com/photos/1649771/pexels-photo-1649771.jpeg{$base}",
            'Підсилювачі' => "https://images.pexels.com/photos/164922/pexels-photo-164922.jpeg{$base}",

            'Фото та відео' => "https://images.pexels.com/photos/274973/pexels-photo-274973.jpeg{$base}",
            'Фотоапарати' => "https://images.pexels.com/photos/274973/pexels-photo-274973.jpeg{$base}",
            'Об’єктиви' => "https://images.pexels.com/photos/51383/pexels-photo-51383.jpeg{$base}",
            'Екшн-камери' => "https://images.pexels.com/photos/276781/pexels-photo-276781.jpeg{$base}",
            'Квадрокоптери' => "https://images.pexels.com/photos/442587/pexels-photo-442587.jpeg{$base}",

            'ТБ та мультимедіа' => "https://images.pexels.com/photos/1201996/pexels-photo-1201996.jpeg{$base}",
            'Телевізори' => "https://images.pexels.com/photos/1201996/pexels-photo-1201996.jpeg{$base}",
            'Smart TV приставки' => "https://images.pexels.com/photos/1092644/pexels-photo-1092644.jpeg{$base}",
            'Проектори' => "https://images.pexels.com/photos/51383/pexels-photo-51383.jpeg{$base}",

            'Гаджети' => "https://images.pexels.com/photos/267394/pexels-photo-267394.jpeg{$base}",
            'Смарт-годинники' => "https://images.pexels.com/photos/267394/pexels-photo-267394.jpeg{$base}",
            'Фітнес-браслети' => "https://images.pexels.com/photos/437037/pexels-photo-437037.jpeg{$base}",
            'VR окуляри' => "https://images.pexels.com/photos/163100/pexels-photo-163100.jpeg{$base}",

            'Мережеве обладнання' => "https://images.pexels.com/photos/325229/pexels-photo-325229.jpeg{$base}",
            'Роутери' => "https://images.pexels.com/photos/325229/pexels-photo-325229.jpeg{$base}",
            'Модеми' => "https://images.pexels.com/photos/325229/pexels-photo-325229.jpeg{$base}",
            'Mesh системи' => "https://images.pexels.com/photos/325229/pexels-photo-325229.jpeg{$base}",

            'Аксесуари' => "https://images.pexels.com/photos/5082576/pexels-photo-5082576.jpeg?auto=compress&cs=tinysrgb&w=800&h=600&fit=crop",
            'Зарядні пристрої' => "https://images.pexels.com/photos/4526423/pexels-photo-4526423.jpeg{$base}",
            'Кабелі' => "https://images.pexels.com/photos/159304/pexels-photo-159304.jpeg{$base}",
            'Power Bank' => "https://images.pexels.com/photos/4526423/pexels-photo-4526423.jpeg{$base}",
            'Чохли' => "https://images.pexels.com/photos/1279107/pexels-photo-1279107.jpeg{$base}",

            default => "https://images.pexels.com/photos/276452/pexels-photo-276452.jpeg{$base}",
        };
    }
}
