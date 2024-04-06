<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BannerCategoryModel;
class BannerCategories_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners_cate_array = [
            ['name' => 'Banner Slider', 'published' => 1, 'ordering' => 1, 'created_at' => '2024-03-23 13:57:14', 'updated_at' => '2024-03-27 06:57:26'],
            ['name' => 'Banner Slider Trang Chủ', 'published' => 1, 'ordering' => 1, 'created_at' => '2024-03-26 02:55:37', 'updated_at' => '2024-03-27 06:57:10'],
            ['name' => 'Banner Sale', 'published' => 1, 'ordering' => 1, 'created_at' => '2024-03-26 03:07:38', 'updated_at' => '2024-03-27 08:57:10'],
            ['name' => 'Group-right-banner-hp', 'published' => 1, 'ordering' => 2, 'created_at' => '2024-03-26 03:02:57', 'updated_at' => '2024-03-26 03:07:38'],
            ['name' => 'Group-bottom-banner-hp', 'published' => 1, 'ordering' => 3, 'created_at' => '2024-03-26 03:04:28', 'updated_at' => '2024-03-28 03:25:30'],
        ];
        foreach ($banners_cate_array as $banners_cate) {
            BannerCategoryModel::create($banners_cate);
        }
    }
}