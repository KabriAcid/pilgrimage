<?php

class SavePicture {


    public function handleUploadedImage($image, $directory)
        {
            if (!is_null($image)) {
                $image->move(public_path('images') . 'temp');
            }
        }



}