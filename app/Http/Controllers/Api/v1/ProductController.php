<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $sortBy = $request->get('sort_by', 'name');
        $orderBy = $request->get('order_by', 'asc');
        $limit = $request->get('limit', 10);

        $products = Product::with('batch')
            ->orderBy($sortBy, $orderBy)
            ->simplePaginate($limit);

        if ($products->isEmpty()) {
            return $this->prepareResponse(null, "Nenhum produto cadastrado.", 404);
        }

        return $this->prepareResponse($products, "Lista de produtos.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $product = Product::with('batch')
            ->find($id);

        if (!$product) {
            return $this->prepareResponse(null, "Produto #$id não encontrado.", 404);
        }

        return $this->prepareResponse($product, "Dados do produto #$id.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        try {

            $product = Product::create($request->all());

            return $this->prepareResponse($product, "Produto cadastrado com sucesso!");

        } catch (\Throwable $e) {
            return $this->prepareResponse($request->all(), $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(ProductRequest $request, $id): JsonResponse
    {
        $product = Product::find($id);

        if (!$product) {
            return $this->prepareResponse(null, "Produto #$id não encontrado.", 404);
        }

        try {

            $product->update($request->all());

            return $this->prepareResponse($product, "Produto atualizado com sucesso!");

        } catch (\Throwable $e) {
            return $this->prepareResponse($request->all(), $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {

        $product = Product::find($id);

        if (!$product) {
            return $this->prepareResponse(null, "Produto #$id não encontrado.", 404);
        }

        try {

            $product->delete();

            return $this->prepareResponse($product, "Produto removido com sucesso!");

        } catch (\Throwable $e) {
            return $this->prepareResponse(["id" => $id], $e->getMessage(), 500);
        }
    }
}