<?php

namespace App\Transformers\Product;

use App\Models\Product;
use League\Fractal\TransformerAbstract;
use App\Transformers\CategoryTransformer;
use App\Transformers\FileTransformer;

class DetailTransformer extends TransformerAbstract
{
    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected $availableIncludes = ['categorys', 'files'];

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = ['categorys', 'files'];

    /**
     * @param Product $product
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'name' => $product->name,
            'slug' => $product->slug,
            'status' => $product->status,
            'created_at' => $product->created_at,
            'categorys' => [],
            'files' => []
        ];
    }

     /**
     * @param Product $product
     * @return \League\Fractal\Resource\Collection
     */
    public function includeCategorys(Product $product)
    {
        return $this->item($product->categorys, new CategoryTransformer());
    }

    /**
     * @param Product $product
     * @return \League\Fractal\Resource\Collection
     */
    public function includeFiles(Product $product)
    {
        return $this->collection($product->files, new FileTransformer());
    }
}
