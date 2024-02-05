<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ProductRepository;
use App\Traits\HandleImagesTrait;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\Hash;

class UserService
{

    use HandleImagesTrait;



    /**
     * @param $request
     * @return mixed
     */

    public function getWithPaginate(): mixed
    {
        $all_users_with_all_their_roles = User::with('roles')->get();
        return $all_users_with_all_their_roles;
    }

    public function store($request): mixed
    {
        try {
            $dataRequest = $request->all();
            $dataRequest['password'] = Hash::make($request->password);

            if (isset($dataRequest['image']) && $dataRequest['image'] != null) {
                $dataRequest['avatar'] = $this->saveImage($request,'image');
            }

            $user = User::create($dataRequest);

            $user->syncRoles($dataRequest['role_ids'] ?? []);

            return redirect()->route('users.index')->with(['message-success' => 'Thêm dữ liệu thành công']);
        } catch (\Exception $e) {
            // Xử lý nếu có lỗi
            $errorMessage = $e->getMessage();
            var_dump($errorMessage); die;
            session('message-error',$errorMessage);
            return false;
            
        }
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
        $product = User::findOrFail($id);
        return $product;
    }

   
}
