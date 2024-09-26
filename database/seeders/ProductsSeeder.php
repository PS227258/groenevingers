<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("products")->insert([
            "stock_keeping_unit" => "KAVA00000000001",
            "api_id" => 600,
            "categorie_id" => 1,
            "name" => "Varen",
            "description" => "De varen is een groep van ongeveer 10.560 bekende nog levende soorten vaatplanten.",
            "price" => "9.99",
            "supply" => 10,
            "img_src" => "https://as1.ftcdn.net/v2/jpg/00/82/09/38/500_F_82093850_KGABJZijejnFxFXYao7kfksuk5CtZxxj.jpg",
            "color" => "Blue",
            "height_cm" => 60,
            "width_cm" => 30,
            "depth_cm" => 30,
            "weight_gr" => 150,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("products")->insert([
            "stock_keeping_unit" => "TUGR00000000002",
            "api_id" => 601,
            "categorie_id" => 2,
            "name" => "Gras",
            "description" => "Gras is een belangrijke familie van monocot planten, graslanden bedekken ongeveer 20% van de aardse vegetatie.",
            "price" => "2.49",
            "supply" => 10,
            "img_src" => "https://as1.ftcdn.net/v2/jpg/00/82/09/38/500_F_82093850_KGABJZijejnFxFXYao7kfksuk5CtZxxj.jpg",
            "color" => "Silver",
            "height_cm" => 40,
            "width_cm" => 10,
            "depth_cm" => 10,
            "weight_gr" => 80,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("products")->insert([
            "stock_keeping_unit" => "KABA00000000003",
            "api_id" => 602,
            "categorie_id" => 1,
            "name" => "Bamboe",
            "description" => "Bamboe is een snelgroeiend gras in de familie Poaceae.",
            "price" => "7.99",
            "supply" => 10,
            "img_src" => "https://as1.ftcdn.net/v2/jpg/00/82/09/38/500_F_82093850_KGABJZijejnFxFXYao7kfksuk5CtZxxj.jpg",
            "color" => "DarkSalmon",
            "height_cm" => 180,
            "width_cm" => 50,
            "depth_cm" => 10,
            "weight_gr" => 500,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("products")->insert([
            "stock_keeping_unit" => "TUKL00000000004",
            "api_id" => 603,
            "categorie_id" => 2,
            "name" => "Klimop",
            "description" => "Klimop is een geslacht van 12-15 soorten klimmende of kruipende altijd groenblijvende houtige planten.",
            "price" => "5.49",
            "supply" => 10,
            "img_src" => "https://as1.ftcdn.net/v2/jpg/00/82/09/38/500_F_82093850_KGABJZijejnFxFXYao7kfksuk5CtZxxj.jpg",
            "color" => "Ivory",
            "height_cm" => 100,
            "width_cm" => 20,
            "depth_cm" => 5,
            "weight_gr" => 200,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("products")->insert([
            "stock_keeping_unit" => "KAAL00000000005",
            "api_id" => 604,
            "categorie_id" => 1,
            "name" => "Aloe Vera",
            "description" => "Aloë vera is een succulente plantensoort die vermoedelijk afkomstig is uit het Arabische schiereiland.",
            "price" => "4.99",
            "supply" => 10,
            "img_src" => "https://as1.ftcdn.net/v2/jpg/00/82/09/38/500_F_82093850_KGABJZijejnFxFXYao7kfksuk5CtZxxj.jpg",
            "color" => "Gold",
            "height_cm" => 30,
            "width_cm" => 15,
            "depth_cm" => 15,
            "weight_gr" => 120,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("products")->insert([
            "stock_keeping_unit" => "TUFI00000000006",
            "api_id" => 605,
            "categorie_id" => 2,
            "name" => "Ficus",
            "description" => "Ficus is een geslacht van ongeveer 850 soorten houtige bomen, struiken en klimplanten in de familie Moraceae.",
            "price" => "8.79",
            "supply" => 10,
            "img_src" => "https://as1.ftcdn.net/v2/jpg/00/82/09/38/500_F_82093850_KGABJZijejnFxFXYao7kfksuk5CtZxxj.jpg",
            "color" => "Snow",
            "height_cm" => 120,
            "width_cm" => 40,
            "depth_cm" => 40,
            "weight_gr" => 400,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("products")->insert([
            "stock_keeping_unit" => "KUGE00000000007",
            "api_id" => 606,
            "categorie_id" => 4,
            "name" => "Geranium",
            "description" => "Geranium is een geslacht van 422 soorten vaste planten die voorkomen in gematigde streken van de wereld.",
            "price" => "6.29",
            "supply" => 10,
            "img_src" => "https://as1.ftcdn.net/v2/jpg/00/82/09/38/500_F_82093850_KGABJZijejnFxFXYao7kfksuk5CtZxxj.jpg",
            "color" => "AntiqueWhite",
            "height_cm" => 50,
            "width_cm" => 25,
            "depth_cm" => 25,
            "weight_gr" => 250,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("products")->insert([
            "stock_keeping_unit" => "TUOL00000000008",
            "api_id" => 607,
            "categorie_id" => 2,
            "name" => "Olijfboom groot",
            "description" => "De olijfboom, Olea europaea, is een kleine boom in de familie Oleaceae.",
            "price" => "11.49",
            "supply" => 10,
            "img_src" => "https://as1.ftcdn.net/v2/jpg/00/82/09/38/500_F_82093850_KGABJZijejnFxFXYao7kfksuk5CtZxxj.jpg",
            "color" => "SeaGreen",
            "height_cm" => 180,
            "width_cm" => 60,
            "depth_cm" => 60,
            "weight_gr" => 600,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("products")->insert([
            "stock_keeping_unit" => "KACH00000000009",
            "api_id" => 608,
            "categorie_id" => 1,
            "name" => "Chrysant",
            "description" => "De chrysant, oftewel Chrysanthemum, is een geslacht van kruidachtige, overblijvende planten.",
            "price" => "5.99",
            "supply" => 10,
            "img_src" => "https://as1.ftcdn.net/v2/jpg/00/82/09/38/500_F_82093850_KGABJZijejnFxFXYao7kfksuk5CtZxxj.jpg",
            "color" => "SandyBrown",
            "height_cm" => 60,
            "width_cm" => 30,
            "depth_cm" => 30,
            "weight_gr" => 300,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);

        DB::table("products")->insert([
            "stock_keeping_unit" => "TUSP00000000010",
            "api_id" => 609,
            "categorie_id" => 2,
            "name" => "Spar",
            "description" => "De spar, of Fijnspar, is een groenblijvende naaldboom in het geslacht Picea.",
            "price" => "9.29",
            "supply" => 10,
            "img_src" => "https://as1.ftcdn.net/v2/jpg/00/82/09/38/500_F_82093850_KGABJZijejnFxFXYao7kfksuk5CtZxxj.jpg",
            "color" => "Plum",
            "height_cm" => 200,
            "width_cm" => 50,
            "depth_cm" => 50,
            "weight_gr" => 500,
            "created_at" => Carbon::now(),
            "updated_at" => Carbon::now()
        ]);
    }
}