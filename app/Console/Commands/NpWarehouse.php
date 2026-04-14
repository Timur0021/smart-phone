<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\NovaPoshta\Services\NPService;
use Symfony\Component\Console\Command\Command as CommandAlias;

class NpWarehouse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'np:wh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse Nova Post Warehouse';

    /**
     * Execute the console command.
     * @throws GuzzleException
     */
    public function handle()
    {
        DB::table('np_warehouses')->delete();

        $response = NPService::getWarehouses(1);
        $data = $response->data;
        $total = $response->info->totalCount;
        $page = 1;
        $totalPage = (int)ceil($total / 500);
        echo($totalPage);

        while ($page <= $totalPage) {
            sleep(1);
            dump($page);
            $res = [];
            foreach ($data as $el) {
                $item = [];

                $item['CityRef'] = $el->CityRef;
                $item['Ref'] = $el->Ref;
                $item['Description'] = $el->Description;
                $item['CityDescription'] = $el->CityDescription;
                $item['ShortAddress'] = $el->ShortAddress;
                $item['Latitude'] = $el->Latitude;
                $item['Longitude'] = $el->Longitude;
                $item['created_at'] = Carbon::now();
                $item['updated_at'] = Carbon::now();
                $res[] = $item;
            }

            $chunks = array_chunk($res, 300);

            foreach ($chunks as $chunk) {
                Log::info('test', [
                    '$chunk' => $chunk,
                ]);
                DB::table('np_warehouses')->insert($chunk);
            }

            $response = NPService::getWarehouses(++$page);
            $data = $response->data;
        }

        return CommandAlias::SUCCESS;
    }
}
