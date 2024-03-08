<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ["name" => "Bluetooth"],
            ["name" => "Có dây"],
            ["name" => "Chụp tai"],
            ["name" => "Nhét tai"],
            ["name" => "Gaming"],
            ["name" => "Thể thao"],
        ];

        foreach ($categories as $item) {
            Category::updateOrCreate($item);
        }
    }
}
