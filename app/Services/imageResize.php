<?php

namespace App\Services;


use Image;
use Storage;
class ImageResize {
/*
* Saves and resizes an image
* @param $image the image sent by the form
* @return string image name
*/

public function imageStore($image){
    $image->store('', 'ProjectImg');
    $image->store('', 'ProjectImg-thumb');
    $imageName = $image->store('', 'ProjectImg-banner');

    $thumb = Image::make(Storage::disk('ProjectImg-thumb')->path($imageName))->resize(300, null,function($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
    });
    $thumb->save();
    $banner = Image::make(Storage::disk('ProjectImg-banner')->path($imageName))->resize(null, 1000 ,function($constraint){
        $constraint->aspectRatio();
        $constraint->upsize();
});
$banner->save();

    return $imageName;
}
/*
* Deletes old images
* @param $image
*/
public function imageDelete($image){
    Storage::disk('imageFolder')->delete($image);
    Storage::disk('imageFolder-thumb')->delete($image);
}
}