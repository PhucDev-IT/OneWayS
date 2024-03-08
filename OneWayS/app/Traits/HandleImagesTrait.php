<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


//Trait là một tập hợp các phương thức được nhóm lại để sử dụng trong nhiều lớp khác nhau. 
//Không cần kế thừa hay khởi tạo cũng có thể sử dụng các method như của mình

trait HandleImagesTrait
{
    protected string $path = 'public/uploads/';
    protected string $fullPath = 'public/storage/uploads';
    public function verify($request,$name)
    {
        //Kiểm tra trường 'image' có tồn tại trong request hay không => T or F
        return $request->has($name);
    }



    public function saveImage($request,$name)
    {
        if ($this->verify($request,$name)) {
            $file = $request->file($name);

        
            return  $this->handleSaveImage($file);
        }
    }
    
    public function saveImages($request,$name){
        if ($this->verify($request,$name)) {
           
            $fileNames = [];
            foreach($request->$name as $value){
                $fileNames[] = $this->handleSaveImage($value);
            }
            
            return $fileNames;
        }
    }

    public function handleSaveImage($file){
      

        $originalFileName = $file->getClientOriginalName();
        
        // Kết hợp thời gian hiện tại và tên file đã chuyển đổi
        $uniqueFileName = time() . '_' . $originalFileName;
        
        // Loại bỏ các ký tự không mong muốn
        $uniqueFileName = preg_replace('/[^a-zA-Z0-9_.]/', '', $uniqueFileName);
        
        $file->storeAs($this->path . $uniqueFileName);

        return  $uniqueFileName;
    }

    /**
     * @paramfilesystems $request
     * @param $request
     * @param $currentImage
     * @return mixed|string|null
     */
    public function updateImage($request,$name, $currentImage): mixed
    {
        if ($this->verify($request,$name)) {
            $this->deleteImage($currentImage);
            return $this->saveImage($request,$name);
        }
        return $currentImage;
    }

    /**
     * @param $imageName
     * @return void
     */
    public function deleteImage($imageName): void
    {
        $filePath = $this->fullPath . $imageName;
    
        if ($imageName && file_exists($filePath)) {
            Storage::delete($filePath);
        }
    }
    
  
}
