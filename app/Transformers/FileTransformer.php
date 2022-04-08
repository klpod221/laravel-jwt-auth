<?php

namespace App\Transformers;

use App\Models\File;
use League\Fractal\TransformerAbstract;

class FileTransformer extends TransformerAbstract
{
    /**
     * @param File $file
     * @return array
     */
    public function transform(File $file)
    {   
        $data = $file->toArray();
        $data['path'] = $file->path ? \Storage::url($file->path) : null;

        return $data;
    }
}
