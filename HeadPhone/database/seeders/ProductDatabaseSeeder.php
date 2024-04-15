<?php

namespace Database\Seeders;

use App\Models\Image;
use App\Models\Product;
use App\Models\ProductDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $desciption = "Headphone là đồ vật quen thuộc với đời sống hàng ngày của chúng ta, đóng góp quan trọng vào quá trình trải nghiệm giải trí và học tập của nhiều người. Đây được xem là công cụ thưởng thức âm thanh linh hoạt và tiện dụng nhất. Tuy nhiên, không ít người lại nhầm lẫn khái niệm về Headphone, đồng thời không phân biệt được thuật ngữ để gọi tên các biến thế khác nhau của headphone.\nMột bộ tai nghe thường bao gồm hai tai nghe, một cho mỗi bên tai. Mỗi tai nghe có chứa một loa nhỏ với màng rất mỏng, có thể xuất ra tất cả các tần số âm thanh, hoặc ít nhất là một phần, phụ thuộc vào giá trị của băng thông của loa. Nếu là tai nghe stereo, tai nghe cho tai phải thường được đánh dấu bằng chữ R (right) hoặc có màu đỏ, tai nghe cho tai trái thường được đánh dấu với chữ(left) hoặc có màu xanh dương.
        
        Trong tiếng Anh, thuật ngữ  (helmet) là bộ tai nghe có hai tai nghe được kết nối bởi một bộ phận bao quanh đầu của người nghe. Bằng cách hoán dụ, còn được gọi là tai nghe Walkman hay earbuds với chất lượng âm thanh thường thấp hơn so với loại thông thường.
        
        Các tai nghe kết nối với một nguồn âm thanh thông qua một phích cắm (hoặc jack cắm), có kích cỡ đường kính 6,35 mm hoặc 3.5 mm (gọi là mini-jack). Ngoài ra còn có jack kết nối 2,5 mm, chủ yếu được sử dụng trên điện thoại di động (nhưng ít dùng và dần dần bị lãng quên). Các thương hiệu tai nghe Stax tĩnh điện có một kiểu jack riêng gọi là kết nối Pro. Tai nghe Koss, Sennheiser tĩnh điện (HE60 HE90) cũng có kiểu riêng.";
        // \App\Models\Product::factory(40)->create();
        $products = [
            //p1
            [
                'name' => 'Tai nghe chụp Buetooth chất lượng cao MW93',
                'price' => 1200000,
                'guarantee_time' => 24,
                'sale' => 12,
                'rate' =>  5,
                'img_preview' => 'head1.jpg',
                'description' => $desciption,
                'supplier_id' => 3
            ],
            //p2
            [
                'name' => 'Tai nghe chụp Buetooth Sony',
                'price' => 350000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => 'head2.jpg',
                'description' => $desciption,
                'supplier_id' => 1
            ],
            //p3
            [
                'name' => '1_Tai nghe Bluetooth Apple AirPods 2 _ Chính hãng Apple Việt Nam',
                'price' => 1450000,
                'guarantee_time' => 12,
                'sale' => 5,
                'rate' =>  5,
                'img_preview' => '1_img.jpg',
                'description' => $desciption,
                'supplier_id' => 4
            ],
            //p4
            [
                'name' => 'Tai nghe có dây, siêu bền, siêu dài',
                'price' => 120000,
                'guarantee_time' => 6,
                'sale' => 12,
                'rate' =>  0,
                'img_preview' => '2_tai_nghe_day.jpg',
                'description' => $desciption,
                'supplier_id' => 2
            ],
            //p5
            [
                'name' => 'Tai nghe Bluetooth True Wireless Baseus Bowie E3',
                'price' => 950000,
                'guarantee_time' => 12,
                'sale' => 5,
                'rate' =>  5,
                'img_preview' => '3_Tai nghe Bluetooth True Wireless Baseus Bowie E3.jpg',
                'description' => $desciption,
                'supplier_id' => 5
            ],
            //p6 -4
            [
                'name' => 'Tai nghe chụp tai Sony MDR-ZX110AP',
                'price' => 340000,
                'guarantee_time' => 12,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '4_Tai nghe chụp tai Sony MDR-ZX110AP (2).jpg',
                'description' => $desciption,
                'supplier_id' => 1
            ],
            //p7-5
            [
                'name' => 'Tai nghe Bluetooth True Wireless Redmi Buds 4 Lite',
                'price' => 460000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '5_Tai nghe Bluetooth True Wireless Redmi Buds 4 Lite.jpg',
                'description' => $desciption,
                'supplier_id' => 5
            ],
            //p8-6
            [
                'name' => 'Tai Nghe Bluetooth Mèo Chụp Tai P47 Có Micro Đàm Thoại, Có Đèn Led 7 màu  siêu cute , Âm Bass Cực Chất ',
                'price' => 5900000,
                'guarantee_time' => 24,
                'sale' => 10,
                'rate' =>  5,
                'img_preview' => '7_img.jpg',
                'description' => $desciption,
                'supplier_id' => 5
            ],
            //p9-7
            [
                'name' => 'Tai Nghe Bluetooth Mèo Chụp Tai P47 Có Micro Đàm Thoại, W843',
                'price' => 1790000,
                'guarantee_time' => 12,
                'sale' => 25,
                'rate' =>  5,
                'img_preview' => '7_img.png',
                'description' => $desciption,
                'supplier_id' => 1
            ],
            //p10-8
            [
                'name' => 'Tai Nghe Bluetooth Mèo Chụp Tai MW93',
                'price' => 2450000,
                'guarantee_time' => 24,
                'sale' => 12,
                'rate' =>  5,
                'img_preview' => '8_img.png',
                'description' => $desciption,
                'supplier_id' => 1
            ],
            //p11-9
            [
                'name' => 'Tai nghe chụp tai chất lượng cao',
                'price' => 467000,
                'guarantee_time' => 12,
                'sale' => 3,
                'rate' =>  5,
                'img_preview' => '9_img.png',
                'description' => $desciption,
                'supplier_id' => 3
            ],
            //p12-10
            [
                'name' => 'Tai nghe chụp Buetooth chất lượng cao chụp tai',
                'price' => 870000,
                'guarantee_time' => 24,
                'sale' => 10,
                'rate' =>  5,
                'img_preview' => '10_img.png',
                'description' => $desciption,
                'supplier_id' => 6
            ],
            //p13-11
            [
                'name' => 'Tai nghe chụp Buetooth chất lượng cao chụp tai',
                'price' => 870000,
                'guarantee_time' => 24,
                'sale' => 10,
                'rate' =>  5,
                'img_preview' => '11_img.jpg',
                'description' => $desciption,
                'supplier_id' => 6
            ],
            //p14-12
            [
                'name' => 'Tai nghe chụp tai âm bass căng',
                'price' => 420000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '12_img.png',
                'description' => $desciption,
                'supplier_id' => 6
            ],
            //p15-13
            [
                'name' => 'Tai nghe không dây Apple chính hãng',
                'price' => 999000,
                'guarantee_time' => 12,
                'sale' => 19,
                'rate' =>  5,
                'img_preview' => '13_img_1.jpeg',
                'description' => $desciption,
                'supplier_id' => 4
            ],
            //p16-14
            [
                'name' => 'Tai nghe chụp Buetooth Huawai chất lượng cao',
                'price' => 378000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '14_img.jpg',
                'description' => $desciption,
                'supplier_id' => 3
            ],
            //p17-15
            [
                'name' => 'Apple | Tai nghe nghe nhạc, chạy bộ',
                'price' => 560000,
                'guarantee_time' => 12,
                'sale' => 5,
                'rate' =>  5,
                'img_preview' => '15_img_2.png',
                'description' => $desciption,
                'supplier_id' => 4
            ],
            //p18-16
            [
                'name' => 'Tai nghe chụp Buetooth chất lượng cao chụp tai',
                'price' => 640000,
                'guarantee_time' => 6,
                'sale' => 10,
                'rate' =>  5,
                'img_preview' => '16_img.png',
                'description' => $desciption,
                'supplier_id' => 2
            ],
            //p-19-17
            [
                'name' => 'Tai nghe Buetooth nhét tai',
                'price' => 50000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '17_img.png',
                'description' => $desciption,
                'supplier_id' => 2
            ],

            //p20-18
            [
                'name' => 'Tai nghe chụp tai siêu bền',
                'price' => 156000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '18_img.png',
                'description' => $desciption,
                'supplier_id' => 6
            ],

            //p21-19 - chưa có
            [
                'name' => 'Tai nghe chụp Buetooth nhét tai',
                'price' => 50000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '19_img.jpg',
                'description' => $desciption,
                'supplier_id' => 2
            ],

            //p22-20
            [
                'name' => 'Tai nghe chụp tai chính hãng mới nhất',
                'price' => 100000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '20_img.png',
                'description' => $desciption,
                'supplier_id' => 6
            ],
            //p23-21
            [
                'name' => 'Tai nghe có dây thể thao',
                'price' => 50000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '21_img.png',
                'description' => $desciption,
                'supplier_id' => 5
            ],
            //p24-22
            [
                'name' => 'Tai nghe chụp tai có dây',
                'price' => 268000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '22_img.png',
                'description' => $desciption,
                'supplier_id' => 3
            ],

            //p25-23
            [
                'name' => 'Tai nghe mèo méo meo chụp tai',
                'price' => 245000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '23_img.png',
                'description' => $desciption,
                'supplier_id' => 1
            ],

            //p26-24
            [
                'name' => 'Tai nghe chụp Buetooth ',
                'price' => 99000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '24_img.png',
                'description' => $desciption,
                'supplier_id' => 6
            ],

            //p27-25 - chưa có
            [
                'name' => 'Tai nghe  nhét tai',
                'price' => 50000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '25_img.jpg',
                'description' => $desciption,
                'supplier_id' => 2
            ],

            //p-2826
            [
                'name' => 'Tai nghe mèo Sony',
                'price' => 67000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '26_img.jpg',
                'description' => $desciption,
                'supplier_id' => 1
            ],

            //p29-27
            [
                'name' => 'Tai nghe chụp tai có dây',
                'price' => 100000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '27_img.png',
                'description' => $desciption,
                'supplier_id' => 5
            ],

            //p30-28
            [
                'name' => 'Tai nghe có dây thể thao cá tính',
                'price' => 55000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '28_img_1.jpg',
                'description' => $desciption,
                'supplier_id' => 3
            ],
            //p31-29
            [
                'name' => 'Tai nghe có dây thể thao',
                'price' => 89000,
                'guarantee_time' => 6,
                'sale' => 0,
                'rate' =>  5,
                'img_preview' => '29_img.jpg',
                'description' => $desciption,
                'supplier_id' => 2
            ],
        ];

        //Thêm ảnh cho từng sản phẩm
        $images = [
            //p1
            [
                'url' => 'head1_1.jpg',
                'imageable_id' => 1,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'head1_2.jpg',
                'imageable_id' => 1,
                'imageable_type' => 'App\Models\Product'
            ],
            //p2
            [
                'url' => 'head2_1.png',
                'imageable_id' => 2,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => 'head2_3.jpg',
                'imageable_id' => 2,
                'imageable_type' => 'App\Models\Product'
            ],
            //p3
            [
                'url' => '1_Tai nghe Bluetooth Apple AirPods 2 _ Chính hãng Apple Việt Nam.jpg',
                'imageable_id' => 3,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '1_Tai nghe Bluetooth Apple AirPods Pro 2 2023 USB-C _ Chính hãng Apple Việt Nam.jpg',
                'imageable_id' => 3,
                'imageable_type' => 'App\Models\Product'
            ],
            //p4
            [
                'url' => '2_tai_nghe_day_1.jpg',
                'imageable_id' => 4,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '2_tai_nghe_day.jpg',
                'imageable_id' => 4,
                'imageable_type' => 'App\Models\Product'
            ],
            //p5
            [
                'url' => '3_Tai nghe Bluetooth True Wireless Baseus Bowie E3.jpg',
                'imageable_id' => 5,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '3_Tai nghe Bluetooth True Wireless SoundPEATS Free2 Classic.jpg',
                'imageable_id' => 5,
                'imageable_type' => 'App\Models\Product'
            ],
            //p6
            
            //p7
            [
                'url' => '5_Tai nghe Bluetooth True Wireless Redmi Buds 4 Lite.jpg',
                'imageable_id' => 7,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '5_Tai nghe Bluetooth True Wireless SoundPEATS Mac.jpg',
                'imageable_id' => 7,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '5_Tai nghe Bluetooth True Wireless SoundPEATS Clear.jpg',
                'imageable_id' => 7,
                'imageable_type' => 'App\Models\Product'
            ],


            //p8
            [
                'url' => '7_img.jpg',
                'imageable_id' => 8,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '7_img_1.png',
                'imageable_id' => 8,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '7_img_2.png',
                'imageable_id' => 8,
                'imageable_type' => 'App\Models\Product'
            ],
            //p10
            [
                'url' => '8_img_1.png',
                'imageable_id' => 10,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '8_img_2.png',
                'imageable_id' => 10,
                'imageable_type' => 'App\Models\Product'
            ],
            //p11
            [
                'url' => '9_img_1.png',
                'imageable_id' =>11,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '9_img_2.png',
                'imageable_id' =>11,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '9_img_3.png',
                'imageable_id' => 11,
                'imageable_type' => 'App\Models\Product'
            ],
            //p12
            [
                'url' => '10_img_1.png',
                'imageable_id' => 12,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '10_img_2.png',
                'imageable_id' => 12,
                'imageable_type' => 'App\Models\Product'
            ],
            //p13
            [
                'url' => '11_img_2.jpg',
                'imageable_id' => 13,
                'imageable_type' => 'App\Models\Product'
            ],
            //p14
            [
                'url' => '12_img.png',
                'imageable_id' => 14,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '12_img_2.jpg',
                'imageable_id' => 14,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '12_img_1.jpg',
                'imageable_id' => 14,
                'imageable_type' => 'App\Models\Product'
            ],
            //p15
            [
                'url' => '13_img.png',
                'imageable_id' => 15,
                'imageable_type' => 'App\Models\Product'
            ],
            //p16

            [
                'url' => '14_img_1.jpg',
                'imageable_id' => 16,
                'imageable_type' => 'App\Models\Product'
            ],
            //p17
            [
                'url' => '15_img.png',
                'imageable_id' => 17,
                'imageable_type' => 'App\Models\Product'
            ],
            //p18
            [
                'url' => '16_img_1.png',
                'imageable_id' => 18,
                'imageable_type' => 'App\Models\Product'
            ],

            [
                'url' => '16_img_2.png',
                'imageable_id' => 18,
                'imageable_type' => 'App\Models\Product'
            ],
            //p19
            [
                'url' => '17_img_1.png',
                'imageable_id' => 19,
                'imageable_type' => 'App\Models\Product'
            ],

            //p20
            [
                'url' => '18_img_1.png',
                'imageable_id' => 20,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '18_img_2.png',
                'imageable_id' => 20,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '18_img_3.png',
                'imageable_id' => 20,
                'imageable_type' => 'App\Models\Product'
            ],
            //p21

            //p22
            [
                'url' => '20_img_1.png',
                'imageable_id' => 22,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '20_img_2.png',
                'imageable_id' => 22,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '20_img_3.png',
                'imageable_id' => 22,
                'imageable_type' => 'App\Models\Product'
            ],
            //p23
            [
                'url' => '21_img_1.png',
                'imageable_id' => 23,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '21_img_2.png',
                'imageable_id' => 23,
                'imageable_type' => 'App\Models\Product'
            ],
            //p24
            [
                'url' => '22_img_1.png',
                'imageable_id' => 24,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '22_img_2.png',
                'imageable_id' => 24,
                'imageable_type' => 'App\Models\Product'
            ],
            //p25
            [
                'url' => '23_img_1.png',
                'imageable_id' => 25,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '23_img_2.png',
                'imageable_id' => 25,
                'imageable_type' => 'App\Models\Product'
            ],
            //p26
            [
                'url' => '24_img_1.jpg',
                'imageable_id' => 26,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '24_img_2.jpg',
                'imageable_id' => 26,
                'imageable_type' => 'App\Models\Product'
            ],

            //p28
            [
                'url' => '26_img_1.jpg',
                'imageable_id' => 28,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '26_img_2.jpg',
                'imageable_id' => 28,
                'imageable_type' => 'App\Models\Product'
            ],
            //p29
            [
                'url' => '27_img_1.jpeg',
                'imageable_id' => 29,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '27_img_2.jpg',
                'imageable_id' => 29,
                'imageable_type' => 'App\Models\Product'
            ],

            //p30
            [
                'url' => '28_img.jpg',
                'imageable_id' => 30,
                'imageable_type' => 'App\Models\Product'
            ],
            [
                'url' => '28_img_2.jpg',
                'imageable_id' => 30,
                'imageable_type' => 'App\Models\Product'
            ],
            //p31
            [
                'url' => '29_img_1.png',
                'imageable_id' => 31,
                'imageable_type' => 'App\Models\Product'
            ],
       
        ];


        //Thêm vào danh mục
        $cate_products = [
            //p1
            [
                'product_id' => 1,
                'category_id' => 1,
            ],
            [
                'product_id' => 1,
                'category_id' => 3,
            ],
            [
                'product_id' => 1,
                'category_id' => 5,
            ],
            //p2
            [
                'product_id' => 2,
                'category_id' => 1,
            ],
            [
                'product_id' => 2,
                'category_id' => 3,
            ],
          

            //p3
            [
                'product_id' => 3,
                'category_id' => 1,
            ],
            [
                'product_id' => 3,
                'category_id' => 4,
            ],
            //p4
            [
                'product_id' => 4,
                'category_id' => 2,
            ],
            [
                'product_id' => 4,
                'category_id' => 4,
            ],
            [
                'product_id' => 4,
                'category_id' => 6,
            ],
            //p5
            [
                'product_id' => 5,
                'category_id' => 1,
            ],
            [
                'product_id' => 5,
                'category_id' => 4,
            ],
            //p6
            [
                'product_id' => 6,
                'category_id' => 6,
            ],
            [
                'product_id' => 6,
                'category_id' => 3,
            ],
            //p7
            [
                'product_id' => 7,
                'category_id' => 1,
            ],
            [
                'product_id' => 7,
                'category_id' => 4,
            ],
            //p8
            [
                'product_id' => 8,
                'category_id' => 1,
            ],
            [
                'product_id' => 8,
                'category_id' => 5,
            ],
            [
                'product_id' => 8,
                'category_id' => 3,
            ],
            //p9
            [
                'product_id' => 9,
                'category_id' => 1,
            ],
            [
                'product_id' => 9,
                'category_id' => 5,
            ],
            [
                'product_id' => 9,
                'category_id' => 3,
            ],
            //p10
            [
                'product_id' => 10,
                'category_id' => 1,
            ],
            [
                'product_id' => 10,
                'category_id' => 5,
            ],
            [
                'product_id' => 10,
                'category_id' => 3,
            ],
            //p11
            [
                'product_id' => 11,
                'category_id' => 1,
            ],
            //p12
            [
                'product_id' => 12,
                'category_id' => 1,
            ],
            [
                'product_id' => 12,
                'category_id' => 3,
            ],
            //13
            [
                'product_id' => 13,
                'category_id' => 3,
            ],
            [
                'product_id' => 13,
                'category_id' => 6,
            ],
            //14
            [
                'product_id' => 14,
                'category_id' => 3,
            ],
            //15
            [
                'product_id' => 15,
                'category_id' => 1,
            ],
            //16
            [
                'product_id' => 16,
                'category_id' => 1,
            ],
            [
                'product_id' => 16,
                'category_id' => 3,
            ],
            //17
            [
                'product_id' => 17,
                'category_id' => 4,
            ],
            //18
            [
                'product_id' => 18,
                'category_id' => 3,
            ],
            //19
            [
                'product_id' => 19,
                'category_id' => 1,
            ],
            [
                'product_id' => 19,
                'category_id' => 4,
            ],
            //20
            
             [
                'product_id' => 20,
                'category_id' => 3,
            ],
            //21
            [
                'product_id' => 21,
                'category_id' => 1,
            ],
            [
                'product_id' => 21,
                'category_id' => 4,
            ],
            //22
            [
                'product_id' =>22,
                'category_id' => 3,
            ],
            //24 - chupk
            [
                'product_id' => 24,
                'category_id' => 3,
            ],

            //25 - nhét
            [
                'product_id' => 25,
                'category_id' => 4,
            ],

            //26 - chụp
            [
                'product_id' => 26,
                'category_id' => 3,
            ],
            [
                'product_id' => 26,
                'category_id' => 5,
            ],
            //27
            [
                'product_id' => 27,
                'category_id' => 2,
            ],
            //28
            [
                'product_id' => 28,
                'category_id' => 1,
            ],
            //29
            [
                'product_id' => 29,
                'category_id' => 1,
            ],
            //30
            [
                'product_id' => 30,
                'category_id' => 1,
            ],
            //31
            [
                'product_id' => 31,
                'category_id' => 4,
            ],

        ];

        //Thêm chi tiêt sản phẩm

        $colors = ['Trắng', 'Đỏ', 'Đen', 'Hồng', 'Tím'];


        $usedColors = []; // Mảng để lưu trữ các màu đã được chọn cho mỗi product_id
        $details = [];
        for ($i = 1; $i <= 31; $i++) {
            $rd = random_int(1, 5);
            $usedColors[$i] = [];
            for ($j = 1; $j <= $rd; $j++) {
                do {
                    $colorIndex = random_int(0, count($colors) - 1);
                    $color = $colors[$colorIndex];
                } while (in_array($color, $usedColors[$i])); // Kiểm tra xem màu đã được sử dụng chưa

                $usedColors[$i][] = $color; // Thêm màu vào mảng đã sử dụng
                $details[] = [
                    'product_id' => $i,
                    'color' => $color,
                    'quantity' => random_int(50, 4000),
                ];
            }
        }

        foreach($products as $product){
            Product::updateOrCreate($product);
        }

        foreach($images as $image){
            Image::updateOrCreate($image);
        }

        foreach($details as $detail){
            ProductDetails::updateOrCreate($detail);
        }
        
        
        foreach($cate_products as $cate){
            DB::table('category_product')->insert($cate);
            
        }
    }
}
