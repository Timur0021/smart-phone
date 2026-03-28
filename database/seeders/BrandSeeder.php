<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Modules\Products\Models\Brand;
use Exception;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Apple' => 'apple.com',
            'Asus' => 'asus.com',
            'Acer' => 'acer.com',
            'Anker' => 'anker.com',
            'Baseus' => 'baseus.com',
            'Beats' => 'beatsbydre.com',
            'Bose' => 'bose.com',
            'Canon' => 'canon.com',
            'Corsair' => 'corsair.com',
            'Dell' => 'dell.com',
            'DJI' => 'dji.com',
            'Epson' => 'epson.com',
            'Google' => 'google.com',
            'Garmin' => 'garmin.com',
            'Huawei' => 'huawei.com',
            'Honor' => 'honor.com',
            'HP' => 'hp.com',
            'JBL' => 'jbl.com',
            'Jabra' => 'jabra.com',
            'Kingston' => 'kingston.com',
            'Lenovo' => 'lenovo.com',
            'LG' => 'lg.com',
            'Logitech' => 'logitech.com',
            'Microsoft' => 'microsoft.com',
            'Motorola' => 'motorola.com',
            'Nokia' => 'nokia.com',
            'OnePlus' => 'oneplus.com',
            'Oppo' => 'oppo.com',
            'Panasonic' => 'panasonic.com',
            'Philips' => 'philips.com',
            'Realme' => 'realme.com',
            'Razer' => 'razer.com',
            'Samsung' => 'samsung.com',
            'Sony' => 'sony.com',
            'Sennheiser' => 'sennheiser.com',
            'TP-Link' => 'tp-link.com',
            'Toshiba' => 'toshiba.com',
            'Ugreen' => 'ugreen.com',
            'Vivo' => 'vivo.com',
            'Western Digital' => 'wd.com',
            'Xiaomi' => 'mi.com',
            'Yamaha' => 'yamaha.com',
            'ZTE' => 'zte.com',
        ];

        foreach ($brands as $name => $domain) {
            $brand = Brand::query()
                ->updateOrCreate(
                    [
                        'slug' => Str::slug($name),
                    ],
                    [
                        'name' => [
                            'uk' => $name,
                            'en' => $name,
                        ],
                        'link' => 'https://' . $domain,
                        'active' => true,
                    ]
                );

            if ($brand->hasMedia('image')) {
                continue;
            }

            try {
                $saved = false;

                $url = "https://logos.hunter.io/{$domain}";

                $response = Http::timeout(10)->get($url);

                if ($response->successful() && strlen($response->body()) > 1000) {
                    $brand
                        ->addMediaFromString($response->body())
                        ->usingFileName($brand->slug . 'png')
                        ->toMediaCollection('image');

                    $saved = true;
                }

                if (!$saved) {
                    $slug = strtolower(str_replace([' ', '-'], '', $name));

                    $simpleUrl = "https://raw.githubusercontent.com/simple-icons/simple-icons/develop/icons/{$slug}.svg";

                    $response = Http::timeout(10)->get($simpleUrl);

                    if ($response->successful()) {
                        $brand->addMediaFromString($response->body())
                            ->usingFileName($brand->slug . '.svg')
                            ->toMediaCollection('image');
                    }
                }
            } catch (Exception $e) {
                Log::error($e->getMessage());
            }
        }
    }
}
