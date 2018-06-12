<?php

namespace App\Services;


use Image;
use Storage;
class ImageResize {
/*
* Saves and resizes an image
* @param $image the image sent by the form
* @param $folder the folder structure to store the images in
* @return string image name
*/

public function imageStore($image, $folder){
    $imageName = $image->store('', $folder);
    $image->store('', $folder.'-thumb');
    $image->store('', $folder.'-banner');

    $thumb = Image::make(Storage::disk($folder.'-thumb')->path($imageName))->resize(300, null,function($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
    });
    $thumb->save();

    $banner = Image::make(Storage::disk($folder.'-banner')->path($imageName))->resize(null, 600 ,function($constraint){
        $constraint->aspectRatio();
        $constraint->upsize();
    });
    $banner->save();

    return $imageName;
}
/*
* Deletes old images
* @param $image $folder
*/
public function imageDelete($image, $folder){
    Storage::disk($folder)->delete($image);
    Storage::disk($folder.'-thumb')->delete($image);
    Storage::disk($folder.'-banner')->delete($image);
}
}