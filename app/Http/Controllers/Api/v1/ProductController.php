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

        $customers = Product::with('batch')
            ->orderBy($sortBy, $orderBy)
            ->simplePaginate($limit);

        if ($customers->isEmpty()) {
            return $this->prepareResponse(null, "Nenhum produto cadastrado.", 404);
        }

        return $this->prepareResponse($customers, "Lista de produtos.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $customer = Product::with('batch')
            ->find($id);

        if (!$customer) {
            return $this->prepareResponse(null, "Produto #$id não encontrado.", 404);
        }

        return $this->prepareResponse($customer, "Dados do produto #$id.");
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

            $customer = Product::create($request->all());

            return $this->prepareResponse($customer, "Produto cadastrado com sucesso!");

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
        $customer = Product::find($id);

        if (!$customer) {
            return $this->prepareResponse(null, "Produto #$id não encontrado.", 404);
        }

        try {

            $customer->update($request->all());

            return $this->prepareResponse($customer, "Produto atualizado com sucesso!");

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

        $customer = Product::find($id);

        if (!$customer) {
            return $this->prepareResponse(null, "Produto #$id não encontrado.", 404);
        }

        try {

            $customer->delete();

            return $this->prepareResponse($customer, "Produto removido com sucesso!");

        } catch (\Throwable $e) {
            return $this->prepareResponse(["id" => $id], $e->getMessage(), 500);
        }
    }
}
