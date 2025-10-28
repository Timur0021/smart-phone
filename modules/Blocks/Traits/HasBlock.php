<?php

namespace Modules\Blocks\Traits;

use Laravel\Pail\Files;
use Modules\Blocks\Filament\Resources\Templates\Button;
use Modules\Blocks\Filament\Resources\Templates\CardList;
use Modules\Blocks\Filament\Resources\Templates\CardWithCounter;
use Modules\Blocks\Filament\Resources\Templates\ColorBackground;
use Modules\Blocks\Filament\Resources\Templates\ColorPickerColor;
use Modules\Blocks\Filament\Resources\Templates\ContainerColorPicker;
use Modules\Blocks\Filament\Resources\Templates\Description;
use Modules\Blocks\Filament\Resources\Templates\DescriptionEditor;
use Modules\Blocks\Filament\Resources\Templates\Faq;
use Modules\Blocks\Filament\Resources\Templates\FaqWithInputs;
use Modules\Blocks\Filament\Resources\Templates\File;
use Modules\Blocks\Filament\Resources\Templates\ImgList;
use Modules\Blocks\Filament\Resources\Templates\ImageWithTitleAndDescription;
use Modules\Blocks\Filament\Resources\Templates\PayAndDelivery;
use Modules\Blocks\Filament\Resources\Templates\RentalConditions;
use Modules\Blocks\Filament\Resources\Templates\SliderBrand;
use Modules\Blocks\Filament\Resources\Templates\ThreeCartsList;
use Modules\Blocks\Filament\Resources\Templates\TitleWithTwoInputsList;
use Modules\Blocks\Filament\Resources\Templates\TitleWithTwoTitleItem;
use Modules\Blocks\Filament\Resources\Templates\IconTitleDescriptionList;
use Modules\Blocks\Filament\Resources\Templates\Image;
use Modules\Blocks\Filament\Resources\Templates\ImageTitleSubtitleButtonItem;
use Modules\Blocks\Filament\Resources\Templates\KeyValue;
use Modules\Blocks\Filament\Resources\Templates\Services;
use Modules\Blocks\Filament\Resources\Templates\SubTitle;
use Modules\Blocks\Filament\Resources\Templates\TextItem;
use Modules\Blocks\Filament\Resources\Templates\TextList;
use Modules\Blocks\Filament\Resources\Templates\Title;
use Modules\Blocks\Filament\Resources\Templates\TitleDescriptionDescriptionEditorList;
use Modules\Blocks\Filament\Resources\Templates\TitleDescriptionEditorList;
use Modules\Blocks\Filament\Resources\Templates\TitleDescriptionTitleDescriptionList;
use Modules\Blocks\Filament\Resources\Templates\TitleEditorTextList;
use Modules\Blocks\Filament\Resources\Templates\TitleImageIconUrlItem;
use Modules\Blocks\Filament\Resources\Templates\IconTitleSubTitleImageList;
use Modules\Blocks\Filament\Resources\Templates\FileAndTwoTitleList;
use function PHPUnit\Framework\isString;

trait HasBlock
{
    const TEMPLATE_WITH_IMAGE = [
        'image',
        'image_mobile',
        'image_list',
        'image_two',
        'banner',
        'image_third',
        'image_forth',
        'image_five',
        'image_second_block_second',
        'image_second_block_first',
        'image_third_block_third',
        'file',
        'file_two',
        'file_two',
        'service_item',
        'detail_item',
        'image_title_description_button_item',
        'card_with_counter_item',
        'detail_item',
        'icon_title_description_item',
        'title_editor_text_list',
        'title_image_icon_url_item',
    ];

    const IMAGE_FIELDS = [
        'image_mobile',
        'image',
        'banner',
        'image_two',
        'image_third',
        'image_forth',
        'image_five',
        'image_second_block_first',
        'image_second_block_second',
        'image_third_block_third',
        'icon',
        'file',
        'file_two',
    ];

    const TRANSLATABLE_FIELDS = [
        'title',
        'description',
        'title_file',
        'title_first',
        'title_second',
        'title_third',
        'title_forth',
        'title_button',
        'title_button_first',
        'title_block_second_first',
        'title_block_second_second',
        'title_block_second_three',
        'title_block_second_forth',
        'title_block_second_fives',
        'title_block_second_six',
        'title_block_second_sevens',
        'title_button_second',
        'title_button_third',
        'title_block_third_first',
        'title_block_third_second',
        'title_block_third_three',
        'title_block_third_forth',
        'subtitle',
        'description_editor',
        'description',
        'text',
        'answer_text',
        'link',
        'key',
        'value',
        'title_one',
        'title_two',
        'title_three',
        'title_for',
        'text_first',
        'text_second',
        'text_third',
        'subtitle',
        'label',
        'question',
        'answer',
        'url',
        'sub_title',
        'text_item',
        'phone',
        'email',
        'content',
    ];

    const MAX_FILE_SIZE = 1024 * 10;
    const MEDDIUM_FILE_SIZE = 1024 * 6;

    public static function getBlocks(): array
    {
        return [
            Title::make(),
            TitleWithTwoInputsList::make(),
            ImageWithTitleAndDescription::make(),
            SubTitle::make(),
            Description::make(),
            DescriptionEditor::make(),
            Button::make(),
            ColorBackground::make(),
            Faq::make(),
            RentalConditions::make(),
            PayAndDelivery::make(),
            SliderBrand::make(),
            FaqWithInputs::make(),
            KeyValue::make(),
            Services::make(),
            ImgList::make(),
            Image::make(),
            File::make(),
            TitleImageIconUrlItem::make(),
            ThreeCartsList::make(),
            FileAndTwoTitleList::make(),
            CardWithCounter::make(),
            CardList::make(),
            TextList::make(),
            TitleEditorTextList::make(),
            IconTitleDescriptionList::make(),
            ColorPickerColor::make(),
            ContainerColorPicker::make(),
            TitleDescriptionTitleDescriptionList::make(),
            IconTitleSubTitleImageList::make(),
        ];
    }

    public function getBlockAttribute()
    {
        $data = $this->content;
        return $this->getBlock($data);
    }

    public function getBlock(array $data = []): array
    {
        $res = [];
        foreach ($data as $value) {
            if (!isset($value['type'])) {
                dd($data);
            }
            $res[] = [
                'type' => $value['type'],
                'data' => $this->getData($value['data']),
            ];
        }
        return $res;
    }


//    public function getData(array $data = []): array
//    {
//        $res = [];
//        foreach ($data as $key => $value) {
//            if (is_array($value) && !in_array($key, self::IMAGE_FIELDS) && !in_array($key, self::TRANSLATABLE_FIELDS)) {
//                $res[] = [
//                    'key' => $key,
//                    'items' => $this->getBlock($value),
//                    'type' => 'items',
//                ];
//            } else {
//                //                if(is_array($value) && in_array($key, self::IMAGE_FIELDS)){
//                //                    dd($data,$key,$value);
//                //                }
//
//                if (in_array($key, self::TRANSLATABLE_FIELDS)) {
//                    if (is_array($value)) {
//                        $locale = app()->getLocale();
//                        if (isset($value[$locale])) {
//                            $value = $value[$locale];
//                        } else {
//                            $value = $value[config('app.fallback_locale')] ?? null;
//                        }
//                    }
//                }
//
//                if (in_array($key, self::IMAGE_FIELDS)) {
//                    if (is_array($value)) {
//                        $new_value = null;
//                        foreach ($value as $image) {
//                            $new_value = $image;
//                        }
//                        $value = $new_value;
//                    }
//                    $value = $value ? asset('storage/' . $value) : null;
//                }
//
//                $res[] = [
//                    'key' => $key,
//                    'value' => $value,
//                    'type' => 'field',
//                ];
//            }
//        }
//        return $res;
//    }
    public function getData(array $data = []): array
    {
        $res = [];

        foreach ($data as $key => $value) {

            if (is_array($value) && !in_array($key, self::IMAGE_FIELDS) && !in_array($key, self::TRANSLATABLE_FIELDS)) {
                if (isset($value[0]) && is_array($value[0]) && isset($value[0]['type'])) {
                    $res[] = [
                        'key' => $key,
                        'items' => $this->getBlock($value),
                        'type' => 'items',
                    ];
                    continue;
                }
            }

            if (in_array($key, self::TRANSLATABLE_FIELDS)) {
                if (is_array($value)) {
                    $locale = app()->getLocale();
                    $value = $value[$locale] ?? $value[config('app.fallback_locale')] ?? null;
                }
            }

            if (in_array($key, self::IMAGE_FIELDS)) {
                if (is_array($value)) {
                    if (isset($value[0]['image'])) {
                        $value = array_map(fn($img) => asset('storage/' . $img['image']), $value);
                    } elseif (isset($value['image'])) {
                        $value = asset('storage/' . $value['image']);
                    } else {
                        $value = array_map(fn($v) => asset('storage/' . $v), $value);
                    }
                } else {
                    $value = $value ? asset('storage/' . $value) : null;
                }
            }

            $res[] = [
                'key' => $key,
                'value' => $value,
                'type' => 'field',
            ];
        }

        return $res;
    }
}
