<?php

namespace Database\Seeders;

use App\Models\Estado;
use App\Models\Region;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $region1 = new Region();$region1->nombre = 'Cañada';$region1->estado_id = 20;$region1->save();
        $region2 = new Region();$region2->nombre = 'Costa';$region2->estado_id = 20;$region2->save();
        $region3 = new Region();$region3->nombre = 'Istmo';$region3->estado_id = 20;$region3->save();
        $region4 = new Region();$region4->nombre = 'Mixteca';$region4->estado_id = 20;$region4->save();
        $region5 = new Region();$region5->nombre = 'Papaloapan';$region5->estado_id = 20;$region5->save();
        $region6 = new Region();$region6->nombre = 'Sierra Norte';$region6->estado_id = 20;$region6->save();
        $region7 = new Region();$region7->nombre = 'Sierra Sur';$region7->estado_id = 20;$region7->save();
        $region8 = new Region();$region8->nombre = 'Valles Centrales';$region8->estado_id = 20;$region8->save();
        
        

    }
}
