<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BannerModel;

class Banners_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banners_array = [
            ['id' => 2, 'parent_id' => 2, 'name' => 'banner-slider-9', 'image' => 'public/images/banner/oYeIvfLkkjU5olAHaJ72DcZmhiWv6thuTfKky1io.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-26 09:41:06', 'updated_at' => '2024-03-28 03:08:48', 'published' => 1, 'ordering' => 1],
            ['id' => 3, 'parent_id' => 2, 'name' => 'banner-slider-7', 'image' => 'public/images/banner/DgR00W2DQUGvItTMBmClCsipCH8toG6OfDn669Yi.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-26 10:34:10', 'updated_at' => '2024-03-28 03:09:10', 'published' => 1, 'ordering' => 1],
            ['id' => 4, 'parent_id' => 2, 'name' => 'banner-slider-10', 'image' => 'public/images/banner/uNNukEpd310T3tXg5BWIhBWNfOBNIqAf3iK7UAcG.png', 'width' => null, 'height' => null, 'created_at' => '2024-03-27 03:32:00', 'updated_at' => '2024-03-28 03:28:55', 'published' => 1, 'ordering' => 1],
            ['id' => 6, 'parent_id' => 5, 'name' => 'Banner-slider-hp2', 'image' => 'public/images/banner/hIhfmf6ctFNnPPYdpuIZZmRtjmvJdGLxLL5yzG2p.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-27 04:27:58', 'updated_at' => '2024-03-28 03:38:56', 'published' => 1, 'ordering' => 1],
            ['id' => 7, 'parent_id' => 4, 'name' => 'banner-right2', 'image' => 'public/images/banner/2NLeSgB7ltoXUEv5B8CAVgikFaezu2TE0ECalOrW.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-27 04:33:34', 'updated_at' => '2024-03-28 03:38:25', 'published' => 1, 'ordering' => 1],
            ['id' => 8, 'parent_id' => 4, 'name' => 'Banner-right-1', 'image' => 'public/images/banner/zKOdCN8133NkPDeCKvNphox4enIE5CGGCxYn53jL.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-27 04:36:57', 'updated_at' => '2024-03-28 03:37:45', 'published' => 1, 'ordering' => 1],
            ['id' => 9, 'parent_id' => 2, 'name' => 'banner-slider-8', 'image' => 'public/images/banner/PkPClMIHfdQ30QcWPAbnWlwhvY4m9jr5pqaY6CA4.png', 'width' => null, 'height' => null, 'created_at' => '2024-03-27 05:01:59', 'updated_at' => '2024-03-28 03:19:17', 'published' => 1, 'ordering' => 1],
            ['id' => 10, 'parent_id' => 2, 'name' => 'banner-slider-5', 'image' => 'public/images/banner/xoLnt3NmvKTzz7emMj2N5skh4aQ7Dmetz6OSB220.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-27 05:08:05', 'updated_at' => '2024-03-28 03:08:25', 'published' => 1, 'ordering' => 1],
            ['id' => 11, 'parent_id' => 2, 'name' => 'banner-slider-1', 'image' => 'public/images/banner/1GHeDL44Ju4GhQaCPTLHuKyab1MCMp3pw6wqTgFV.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-27 07:04:02', 'updated_at' => '2024-03-27 07:04:02', 'published' => 1, 'ordering' => 1],
            ['id' => 12, 'parent_id' => 2, 'name' => 'banner-slider-2', 'image' => 'public/images/banner/CzteHVMWyy3l6mQ6NAyU6QLPYrCOTGFPSjABBljP.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-27 07:44:27', 'updated_at' => '2024-03-27 07:44:27', 'published' => 1, 'ordering' => 1],
            ['id' => 14, 'parent_id' => 2, 'name' => 'banner-slider-3', 'image' => 'public/images/banner/3iO9RyndUdPnJpiJwuNbLDnOWaMEeKMpQw54QCf9.png', 'width' => null, 'height' => null, 'created_at' => '2024-03-27 07:45:54', 'updated_at' => '2024-03-27 09:45:48', 'published' => 1, 'ordering' => 1],
            ['id' => 15, 'parent_id' => 2, 'name' => 'banner-slider-4', 'image' => 'public/images/banner/DqIBws72z6sn2flyVMz0HqD7LVRzDHFXnHI4PM1h.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-27 09:22:43', 'updated_at' => '2024-03-27 09:46:58', 'published' => 1, 'ordering' => 1],
            ['id' => 16, 'parent_id' => 5, 'name' => 'banner-bottom-1', 'image' => 'public/images/banner/26WR6fLywasDdNlUf17Zw4zidXDzb5ceUYkwNO0R.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-28 03:39:36', 'updated_at' => '2024-03-28 04:03:10', 'published' => null, 'ordering' => 1],
            ['id' => 17, 'parent_id' => 5, 'name' => 'banner-bottom-3', 'image' => 'public/images/banner/LSAnT3Hr8fOeS0zYJSkmopnVw8ZF8h3MXQi3nobd.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-28 03:40:04', 'updated_at' => '2024-03-28 03:40:04', 'published' => 1, 'ordering' => 1],
            ['id' => 18, 'parent_id' => 5, 'name' => 'banner-bottom-4', 'image' => 'public/images/banner/xuPi1tolfKO9PI50YB6eQlbZJmxOhwihsK69Yehd.jpg', 'width' => null, 'height' => null, 'created_at' => '2024-03-28 04:02:06', 'updated_at' => '2024-03-28 04:02:06', 'published' => 1, 'ordering' => 1],
        ];

        foreach ($banners_array as $banner) {
            BannerModel::create($banner);
        }
    }
}