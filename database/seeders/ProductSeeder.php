<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Products\Models\Brand;
use Modules\Products\Models\Category;
use Modules\Products\Models\Product;
use Modules\Products\Models\Value;
use Throwable;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Product::query()->delete();

        $valuesByCharacteristic = Value::query()
            ->with('characteristic')
            ->get()
            ->groupBy(fn ($value) =>
                $value->characteristic?->getTranslation('name', 'uk')
            );

        $productImages = [
            'Смартфони' => [
                'https://images.unsplash.com/photo-1695048133142-1a20484d2569',
                'https://images.unsplash.com/photo-1603899122634-f086ca5f5ddd',
                'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9',
                'https://images.unsplash.com/photo-1598327105666-5b89351aff97',
                'https://images.unsplash.com/photo-1580910051074-3eb694886505',
                'https://images.unsplash.com/photo-1567581935884-3349723552ca',
                'https://images.unsplash.com/photo-1583573636246-18cb2246697f',
            ],

            'Ноутбуки' => [
                'https://images.unsplash.com/photo-1496181133206-80ce9b88a853',
                'https://images.unsplash.com/photo-1517336714739-489689fd1ca8',
                'https://images.unsplash.com/photo-1498050108023-c5249f4df085',
                'https://images.unsplash.com/photo-1504707748692-419802cf939d',
                'https://images.unsplash.com/photo-1525547719571-a2d4ac8945e2',
                'https://images.unsplash.com/photo-1541807084-5c52b6b3adef',
                'https://images.unsplash.com/photo-1593642632823-8f785ba67e45',
            ],

            'Навушники' => [
                'https://images.unsplash.com/photo-1505740420928-5e560c06d30e',
                'https://images.unsplash.com/photo-1484704849700-f032a568e944',
                'https://images.unsplash.com/photo-1546435770-a3e426bf472b',
                'https://images.unsplash.com/photo-1577174881658-0f30ed549adc',
                'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb',
                'https://images.unsplash.com/photo-1583394838336-acd977736f90',
                'https://images.unsplash.com/photo-1613040809024-b4ef7ba99bc3',
            ],
        ];

        $characteristicsByCategory = [
            'Смартфони' => ['Бренд','Колір','Памʼять','Екран','Процесор','Батарея'],
            'Ноутбуки' => ['Бренд','Колір','Памʼять','Екран','Процесор'],
            'Навушники' => ['Бренд','Колір'],
        ];

        $baseProducts = [
            'Смартфони' => ['iPhone 15 Pro','Samsung Galaxy S25','Xiaomi 15 Pro'],
            'Ноутбуки' => ['MacBook Air M2','Dell XPS 15','Lenovo ThinkPad X1'],
            'Навушники' => ['AirPods Pro 2','Sony WH-1000XM5','JBL Tune 770NC'],
        ];

        $allCategories = ['Смартфони','Ноутбуки','Навушники'];

        $brands = Brand::all();
        $categories = Category::all()
            ->keyBy(fn ($c) => $c->getTranslation('name', 'uk'));

        for ($i = 1; $i <= 50; $i++) {
            $categoryName = $allCategories[array_rand($allCategories)];
            $category = $categories[$categoryName] ?? null;

            if (!$category) continue;

            $brand = $brands->isNotEmpty()
                ? $brands->random()
                : null;

            if (!$brand) continue;

            $baseName = $baseProducts[$categoryName][array_rand($baseProducts[$categoryName])];

            $uniqueName = $baseName . ' #' . $i . ' ' . Str::random(4);

            $product = Product::query()
                ->create([
                    'name' => ['uk' => $uniqueName],
                    'short_description' => ['uk' => 'Короткий опис ' . $baseName],
                    'description' => ['uk' => 'Детальний опис ' . $baseName],
                    'meta_title' => ['uk' => $baseName],
                    'meta_description' => ['uk' => 'Купити ' . $baseName],
                    'quantity' => rand(1, 100),
                    'price' => rand(1000, 100000),
                    'old_price' => rand(1000, 120000),
                    'discount' => rand(0, 30),
                    'brand_id' => $brand->id,
                    'active' => true,
                ]);

            $product->categories()->attach($category->id);

            $valueIds = [];

            foreach ($characteristicsByCategory[$categoryName] ?? [] as $char) {
                if (isset($valuesByCharacteristic[$char])) {
                    $valueIds[] = $valuesByCharacteristic[$char]->random()->id;
                }
            }

            $product->values()->sync($valueIds);

            $images = collect($productImages[$categoryName])->shuffle()->values();

            $product->clearMediaCollection('image');
            $product->clearMediaCollection('images');

            foreach ($images as $index => $image) {
                try {
                    if ($index === 0) {
                        $product->addMediaFromUrl($image)
                            ->toMediaCollection('image');
                    } else {
                        $product->addMediaFromUrl($image)
                            ->toMediaCollection('images');
                    }
                } catch (Throwable $e) {
                    continue;
                }
            }
        }
    }
}
