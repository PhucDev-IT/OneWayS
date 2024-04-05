<?php

namespace App\Models;

use App\Traits\HandleImagesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HandleImagesTrait;

    protected $fillable = [
        'product_id',
        'name',
        'description',
        'price',
       'guarantee_time',
        'sale',
        'rate',
        'createdat',
        'published',
        'img_preview',
        'supplier_id'
    ];

    // protected static function boot()
    // {
    //     parent::boot();

    //     // Sự kiện trước khi tạo mới order
    //     static::creating(function ($product) {
    //         $product->product_id = self::generateRandomString();
    //     });
    // }


    // public static function generateRandomString($length = null) {
    //     $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    //     $charactersLength = strlen($characters);
    //     $length = $length ?? rand(6, 10);
    //     $randomString = '';
    
    //     for ($i = 0; $i < $length; $i++) {
    //         $randomString .= $characters[rand(0, $charactersLength - 1)];
    //     }
    
    //     return $randomString;
    // }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function syncImages($imageNames)
    {
        // Biến đổi mảng chuỗi thành mảng đa chiều với các mảng associatives
        $urlArray = array_map(function ($url) {
            return ['url' => $url];
        }, $imageNames);
 
        // Thêm ảnh mới
        $this->images()->createMany($urlArray);
    }

    public function categories()
    {
        //Quan hệ n-n
        return $this->belongsToMany(Category::class);
    }

  

    public function assignCategory($categoryIds)
    {
        return $this->categories()->sync($categoryIds);
    }

    public function details()
    {
        //Quan hệ 1-n
        return $this->hasMany(ProductDetails::class);
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class);
    }
}
