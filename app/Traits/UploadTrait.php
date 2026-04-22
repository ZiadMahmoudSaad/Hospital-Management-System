<?php

namespace App\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

trait UploadTrait
{
    public function StoreImage(Request $request,$name,$inputname,$foldername,$disk,$imageable_id, $imageable_type)
    {
        if($request->hasFile($inputname))
        {
                if(!$request->file($inputname)->isValid())
                {
                    session()->flash('Invalid Image!')->error()->importent();
                    return redirect()->back()->withInput();
                }

                $photo =$request->file($inputname);
                $name =\Str::slug($name);
                $filename = $name.'.'.$photo->getClientOriginalExtension();
                $Image = new Image();
                $Image->file_name = $filename;
                $Image->imageable_id = $imageable_id;
                $Image->imageable_type = $imageable_type;
                $Image->save();

                return $request->file($inputname)->storeAs($foldername, $filename, $disk);
        }

        return null;
    }

    public function StoreImageForeach($varforeach , $foldername , $disk, $imageable_id, $imageable_type)
    {
        // insert Image
        $Image = new Image();
        $Image->filename = $varforeach->getClientOriginalName();
        $Image->imageable_id = $imageable_id;
        $Image->imageable_type = $imageable_type;
        $Image->save();
        return $varforeach->storeAs($foldername, $varforeach->getClientOriginalName(), $disk);
    }

    public function Delete_attachment($disk,$path,$id){

        Storage::disk($disk)->delete($path);
        image::where('imageable_id',$id)->delete();

    }
}
