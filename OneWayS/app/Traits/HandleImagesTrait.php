<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


//Trait là một tập hợp các phương thức được nhóm lại để sử dụng trong nhiều lớp khác nhau. 
//Không cần kế thừa hay khởi tạo cũng có thể sử dụng các method như của mình

trait HandleImagesTrait
{
    protected string $path = 'public/uploads/';
    public function verify($request)
    {
        //Kiểm tra trường 'image' có tồn tại trong request hay không => T or F
        return $request->has('image');
    }

    public function saveImage($request)
    {
        if ($this->verify($request)) {
            $file = $request->file('image');
            $name = time() . $file->getClientOriginalName();
            $extension = $file->getClientOriginalExtension();
            $image = Image::make($file)->resize(300, 300);
            
            // Sử dụng save() để lưu hình ảnh vào storage
            $image->save(storage_path("app/{$this->path}{$name}"));
    
            return $name;
        }
    }
    

    /**
     * @paramfilesystems $request
     * @param $request
     * @param $currentImage
     * @return mixed|string|null
     */
    public function updateImage($request, $currentImage): mixed
    {
        if ($this->verify($request)) {
            $this->deleteImage($currentImage);
            return $this->saveImage($request);
        }
        return $currentImage;
    }

    /**
     * @param $imageName
     * @return void
     */
    public function deleteImage($imageName): void
    {
        if ($imageName && file_exists($this->path . $imageName)) {
            Storage::delete($this->path . $imageName);
        }
    }
  
}
