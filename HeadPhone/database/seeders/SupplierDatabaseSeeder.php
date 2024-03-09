<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suppliers = [
            ["name" => "Sony"],
            ["name" => "SamSung"],
            ["name" => "Huawei"],
            ["name" => "Apple"],
            ["name" => "Xiaomi"],
            ["name" => "Asus"],
        ];

        foreach($suppliers as $item){
            Supplier::updateOrCreate($item);
        }
    }
}
