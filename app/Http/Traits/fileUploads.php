<?php

namespace App\Http\Traits;
//use Intervention\Image\Facades\Image;
use Image;
use Illuminate\Support\Facades\File;
trait FileUploadTraits
{
  public function uploadImage($image, $paths)
  {
      $publicPath = public_path('/images/'.$paths);
     
      if(!File::isDirectory($publicPath)){
          
        $this->create_folder($paths);
      }
      
      $img = Image::make($image);
      $img->encode('jpg', 'png', 'pdf','JPG');
      $filenameWithExt = $image->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $image->getClientOriginalExtension();
      $image_name = $filename.'-'.time().'.'.$extension;
      $img->save(public_path('/images/'.$paths.$image_name));
      return $image_name;
  }

       public function create_folder($paths)
      {
        File::makeDirectory(public_path(). '/images/'. $paths);
      }


//    public function checkIfImageExists($folder, $image_name)
//    {
//        if(file_exists(public_path() . '/images/' . $folder . '/' . $image_name)){
//            return true;
//        }
//
//        return false;
//    }


    public function checkIfFolderExist($paths)
      {
          if(file_exists(public_path(). '/images/'. $paths))
          {
              return true;
          }
          return false;
      }

      public function delete_image($folder, $image_name){
        if($this->checkIfFolderExist($folder)){
            if (file_exists(public_path().'/images/'. $folder.'/'.$image_name)){
                unlink(public_path() . '/images/' . $folder . '/'.$image_name);
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }





}
