<?php

namespace App\Traits;

trait employeeTrait
{

    function saveFile($file, $folder)
    {
        if(!$file){
            return '';
        }
        else
        {
            $file_extension = $file->getClientOriginalExtension();
            $file_name = time() . '.' . $file_extension;
            $file_path = $folder;

            $file->move($file_path, $file_name);

            return $folder.$file_name;
        }

    }

}
