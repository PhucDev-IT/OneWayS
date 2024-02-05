<?php

namespace App\Models;

use App\Services\ProductService;
use App\Traits\HandleImagesTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HandleImagesTrait;

    protected $fillable = [
        'name',
        'description',
        'price',
        'sale',
        'rate',
        'createdat',
        'img_preview'
    ];

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }


    public function syncImages($imageNames)
    {
        // Chuyển đổi mảng tên ảnh thành mảng chứa các mảng associatives
        $imageData = array_map(function ($imageName) {
            return ['url' => $imageName];
        }, $imageNames);

        // Thêm ảnh mới
        $this->images()->createMany($imageData);
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

   
}
