<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Modules\Blogs\Models\Blog;
use Modules\Blogs\Models\BlogCategory;

class BlogSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = BlogCategory::query()
            ->where('active', true)
            ->get();

        if ($categories->isEmpty()) {
            $this->command->warn('Немає активних категорій блогів');
            return;
        }

        foreach (range(1, 20) as $index) {
            $title = $this->randomTitle();

            $blog = Blog::query()
                ->create([
                    'name' => [
                        'uk' => $title,
                    ],
                    'short_description' => [
                        'uk' => $this->randomShortDescription(),
                    ],
                    'description' => [
                        'uk' => $this->generateEditorHtml(),
                    ],
                    'category_id' => $categories->random()->id,
                    'active' => true,
                    'published_at' => now()->subDays(rand(0, 120)),
                    'meta_title' => [
                        'uk' => $title,
                    ],
                    'meta_description' => [
                        'uk' => $this->randomShortDescription(),
                    ],
                ]);

            // Завантажуємо стабільне головне фото через placehold.co
            $tmpPath = storage_path('app/tmp_blog_' . Str::random(8) . '.png');

            $response = Http::timeout(10)->get('https://placehold.co/1200x800/png');

            if ($response->successful() && str_starts_with($response->header('Content-Type'), 'image')) {
                file_put_contents($tmpPath, $response->body());

                $blog
                    ->addMedia($tmpPath)
                    ->preservingOriginal()
                    ->toMediaCollection('image');
            }

            @unlink($tmpPath);
        }
    }

    private function randomTitle(): string
    {
        $titles = [
            'Як обрати цінний колекційний предмет',
            'Антикваріат як інвестиція',
            'Що впливає на вартість лота',
            'Колекціонування: помилки новачків',
            'Рідкісні речі та їх історія',
            'Тренди сучасного арт-ринку',
            'Як перевірити автентичність предмета',
        ];

        return $titles[array_rand($titles)];
    }

    private function randomShortDescription(): string
    {
        $texts = [
            'Практичний матеріал з порадами та прикладами для правильного вибору.',
            'Аналітичний огляд ключових факторів, що формують цінність предметів.',
            'Корисна інформація для тих, хто хоче глибше зрозуміти ринок.',
            'Огляд реальних кейсів та рекомендації експертів.',
            'Матеріал, який допоможе уникнути типових помилок.',
        ];

        return $texts[array_rand($texts)];
    }

    private function generateEditorHtml(): string
    {
        $sections = [
            'Загальне враження від події',
            'Ключові оновлення та анонси',
            'Демонстрація можливостей',
            'Атмосфера та організація',
            'Практична користь для команди',
            'Підсумки та враження',
        ];

        $texts = [
            'Подія залишила позитивні емоції та дала змогу краще зрозуміти напрям розвитку сучасних технологій.',
            'Презентація була насиченою, динамічною та добре структурованою, що дозволило легко сприймати інформацію.',
            'Особливу увагу привернули нові функції, які орієнтовані на покращення щоденного користувацького досвіду.',
            'Живе спілкування та демонстрація рішень допомогли оцінити потенціал продукту.',
            'Організація заходу відповідала високим стандартам та створювала відчуття залученості.',
            'Отримані знання та ідеї стануть корисними у подальшій роботі та розвитку команди.',
        ];

        $imagesCount = rand(1, 2);
        $imagePositions = array_rand(range(0, count($sections) - 1), $imagesCount);

        $html = '';

        foreach ($sections as $index => $title) {

            $html .= '<p>';
            $html .= '<strong>' . ($index + 1) . '. ' . $title . '</strong><br />';
            $html .= $texts[array_rand($texts)];
            $html .= '</p>';

            if (in_array($index, (array) $imagePositions, true)) {
                $float = rand(0, 1) ? 'right' : 'left';
                $margin = $float === 'right' ? '0 0 16px 16px' : '0 16px 16px 0';

                $img = "https://loremflickr.com/568/325/technology,event?random=" . rand(1, 9999);

                $html .= '
<p>
    <img
        style="float: ' . $float . '; margin: ' . $margin . ';"
        src="' . $img . '"
        alt=""
        width="568"
        height="325"
    />
</p>';
            }
        }

        return $html;
    }
}
