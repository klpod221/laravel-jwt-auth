<?php

namespace App\Services;

use App\Models\File;
use App\Models\Product;
use App\Services\BaseService;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService extends BaseService
{
    /**
     * ProductService constructor.
     *
     * @param Product $product
     */
    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    /**
     * @param array $params
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getList($params = [])
    {
        $limit = $params['limit'] ?? config('const.default_limit');

        $query = $this->model->newQuery();

        // Search by keyword
        if ($params['keyword'] ?? false) {
            // $query->where('name', 'ILIKE', "%$params[keyword]%");
            $query->where('name', 'LIKE', "%$params[keyword]%");
        }

        $query->orderBy('created_at');
        $query->sortNewest();

        return $query->paginate($limit);
    }

    /**
     * @param array $input
     * @return Product
     * @throws \Throwable
     */
    public function create(array $input = []): Product
    {
        DB::beginTransaction();
        try {
            $params = [
                'category_id' => $input['category_id'] ?? null,
                'name' => $input['name'] ?? null,
                'slug' => $input['name'] ? \Str::slug($input['name']) : null,
                'status' => $input['status'] ?? null
            ];
            if (!isset($input['id'])) {
                $params = array_merge($params, [
                    'category_id' => $input['category_id'] ?? null
                ]);
            }
            $product = $this->model->create($params);

            $files = $input['files'] ?? [];
            if ($files) {
                $fileIDs = [];
                foreach ($files as $file) {
                    $filePath = $file->store('products');
                    $fileCreated = $product->files()->create([
                        'name' => $filePath,
                        'path' => $filePath,
                        'type' => File::TYPE_PRODUCT
                    ]);
                    array_push($fileIDs, $fileCreated->id);
                }
                $product->files()->attach($fileIDs)->save();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            throw new GeneralException($e->getMessage());
        }
        DB::commit();

        return $product;
    }
}
