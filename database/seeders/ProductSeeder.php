<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert([
            [
            'name'=>'Rare D Axe RF Classic',
            'price'=>'7000000',
            'description'=>'Rare D Axe +5',
            'category'=>'Item',
            "gallery"=>"http://images.lytogame.com/rfclassic/berita/tempa2d.png",
            ],
            [
                'name'=>'Diamond Mobile Legend',
                'price'=>'330',
                'description'=>'Diamond termurah Mobile Legend',
                'category'=>'Diamond',
                "gallery"=>"https://garudavoucher-dc1.b-cdn.net/wp-content/uploads/2018/09/Mobile-legend.jpg",
            ],
            [
                'name'=>'Akun Mobile Legend',
                'price'=>'500000',
                'description'=>'Akun Mobile Legend Battle Poin 300rb fragment 2400',
                'category'=>'Akun',
                "gallery"=>"https://i.ytimg.com/vi/egtqFcRuhBc/maxresdefault.jpg",
            ]


            ]);
    }
}
