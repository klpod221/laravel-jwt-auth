<?php

namespace App\Api\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Api\Controllers\BaseController;
use App\Api\Requests\Product\StoreRequest;
use App\Api\Requests\Product\SearchRequest;
use App\Transformers\Product\ListTransformer;
use App\Transformers\Product\DetailTransformer;


class ProductController extends BaseController
{
    /**
     * @var ProductService
     */
    protected $productService;

    /**
     * ProfileController constructor.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    /**
     * Get paginated list with filters
     *
     * @param SearchRequest $searchRequest
     * @return mixed
     */
    public function index(SearchRequest $searchRequest)
    {
        $queryParams = $searchRequest->only('keyword', 'is_managed', 'limit');
        if ($queryParams['is_managed'] ?? false) {
            // $queryParams['category_id'] =  ????;
        }
        $resumes = $this->productService->getList($queryParams);

        return responder()->paginate($resumes, new ListTransformer());
    }

    /**
     * Get by id
     *
     * @param Product $product
     * @return mixed
     */
    public function show(Product $product)
    {
        $product->load(['categorys']);
        return responder()->data($product, new DetailTransformer);
    }

    /**
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse|mixed
     * @throws \Throwable
     */
    public function store(StoreRequest $request)
    {
        $input = $request->all();
        $this->productService->create($input);

        return responder()->created();
    }
}
