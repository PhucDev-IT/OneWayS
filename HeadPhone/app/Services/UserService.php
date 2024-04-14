<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\ProductRepository;
use App\Traits\HandleImagesTrait;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserService
{

    use HandleImagesTrait;



    /**
     * @param $request
     * @return mixed
     */

    public function getWithPaginate(): mixed
    {
        $all_users_with_all_their_roles = User::with('getRoles')->latest('created_at')->paginate(10);

        return $all_users_with_all_their_roles;
    }

    public function store($request): mixed
    {   
        try {
            $dataRequest = $request->all();
    
            $dataRequest['password'] = Hash::make($request->password);

            if (isset($dataRequest['image']) && $dataRequest['image'] != null) {
                $dataRequest['avatar'] = $this->saveImage($request, 'image');
            }

            $user = User::create($dataRequest);

            $user->assignUserRole($dataRequest['role_ids'] ?? []);

            return true;
        } catch (\Exception $e) {
           
            Log::error($e->getMessage());
         
            return back()->withInput();
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
            $user = $this->findOrFail($id);

            $dataRequest = $request->all();
            if ($user['password'] !== $dataRequest['password']) {
                $dataRequest['password'] = Hash::make($request->password);
            }

            if (isset($dataRequest['image']) && $dataRequest['image'] != null) {
                $dataRequest['avatar'] = $this->updateImage($request, 'image', $dataRequest['image']);
            }

            $user->update($dataRequest);

            $user->syncRoles($dataRequest['role_ids'] ?? []);

            return true;
        } catch (\Exception $e) {
            // Xử lý nếu có lỗi
            $errorMessage = $e->getMessage();
            var_dump($errorMessage);
            die;
            session('message-error', $errorMessage);
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
        return User::findOrFail($id);
    }


    //Khóa tài khoản
    public function lockOnUser($id, $status)
    {
        try {
            $user = $this->findOrFail($id);

            $user->update(['status' => $status]);

            return true;
        } catch (\Exception $e) {
            // Xử lý nếu có lỗi
            $errorMessage = $e->getMessage();

            return false;
        }
    }
}
