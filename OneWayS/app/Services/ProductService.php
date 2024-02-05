<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use App\Traits\HandleImagesTrait;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;


class ProductService
{

    use HandleImagesTrait;



    /**
     * @param $request
     * @return mixed
     */

    public function getWithPaginate(): mixed
    {
        return Product::query()->latest('rate')->paginate(10);
    }

    public function store($request): mixed
    {
        $dataCreate = $request->all();

        $classifies = $request->classifies ? json_decode($request->classifies) : [];
        $dataCreate['img_preview'] = $this->saveImage($request, 'img_preview');
        $dataCreate['images'] =  $this->saveImages($request, 'images');
        $product = Product::create($dataCreate);
        $this->updateDetail($product, $dataCreate, $classifies);

        return $product;
    }

    /**
     * @param $request
     * @param $id
     * @return mixed
     */
    public function update($request, $id): bool
    {
        try {
            $product = $this->findOrFail($id)->load(['images']);
            $dataUpdate = $request->all();
    
            // Xử lý ảnh cũ và ảnh mới
            $oldImages = $request->data_images ? json_decode($request->data_images) : [];
            $classifies = $request->classifies ? json_decode($request->classifies) : [];
    
            foreach ($oldImages as $image) {
                if (!$product->images->contains('id', $image)) {
                    $this->deleteImage($image->url);
                }
            }
    
            $dataUpdate['img_preview'] =  $this->updateImage($request, 'img_preview', $product->img_preview);
            $dataUpdate['images'] =  $this->saveImages($request, 'images');
    
            $product->update($dataUpdate);
            $product->images()->delete();
            $product->syncImages($oldImages);
            $product->details()->delete();
            $this->updateDetail($product, $dataUpdate, $classifies);
    
            return true;
        } catch (\Exception $e) {
            // Xử lý nếu có lỗi
            $errorMessage = $e->getMessage();
            // Có thể log lỗi hoặc trả về thông báo lỗi cho người dùng
            return false;
        }
    }
    

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id): mixed
    {
        $product = $this->findOrFail($id);
        $product->delete();
        $product->deleteImage();
        $this->deleteImage($product?->images?->first()?->url);

        return $product;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id): mixed
    {
        $product = Product::findOrFail($id);
        return $product;
    }

    /**
     * @param mixed $product
     * @param mixed $dataCreate
     * @param mixed $sizes
     * @return null|Product
     */
    public function updateDetail(Product $product, mixed $dataCreate, $classifies): Product|null
    {

        $product->syncImages($dataCreate['images'] ?? []);

        $product->assignCategory($dataCreate['category_ids'] ?? []);
        $proDetails = [];


        foreach ($classifies as $classify) {
            $proDetails[] = ['color' => $classify->color, 'quantity' => $classify->quantity, 'product_id' => $product->id];
        }
        $product->details()->insert($proDetails);

        return $product;
    }
}
