<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\NovaPoshta\Services\NPService;

class NpCities extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'np:cities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse Nova Post City';

    /**
     * Execute the console command.
     * @throws GuzzleException
     */
    public function handle()
    {
        DB::table('np_cities')->delete();

        $response = NPService::getCities();
        $res = [];

        foreach ($response->data as $el) {
            $item = [];
            $item['Description'] = $el->Description;
            $item['SettlementTypeDescription'] = $el->SettlementTypeDescription;
            $item['Ref'] = $el->Ref;
            $item['CityID'] = $el->CityID;
            $item['created_at'] = Carbon::now();
            $item['updated_at'] = Carbon::now();
            $res[] = $item;
        }

        $chunks = array_chunk($res, 300);

        foreach ($chunks as $chunk) {
            Log::info('test',[
                'chunk' => $chunk,
            ]);
            DB::table('np_cities')->insert($chunk);
        }
    }
}
