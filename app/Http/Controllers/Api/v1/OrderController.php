<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $sortBy = $request->get('sort_by', 'amount');
        $orderBy = $request->get('order_by', 'asc');
        $limit = $request->get('limit', 10);

        $orders = Order::with(['customer', 'seller', 'products'])
            ->orderBy($sortBy, $orderBy)
            ->simplePaginate($limit);

        if ($orders->isEmpty()) {
            return $this->prepareResponse(null, "Nenhum pedido cadastrado.", 404);
        }

        return $this->prepareResponse($orders, "Lista de pedidos.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $order = Order::with(['customer', 'seller', 'products'])
            ->find($id);

        if (!$order) {
            return $this->prepareResponse(null, "Pedido #$id não encontrado.", 404);
        }

        return $this->prepareResponse($order, "Dados do pedido #$id.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return JsonResponse
     */
    public function store(OrderRequest $request): JsonResponse
    {
        try {

            $data = [
                "seller_id" => $request->get('seller_id'),
                "customer_id" => $request->get('customer_id'),
                "code" => mb_strtoupper(date('dmyhis') . Str::random(6)),
                "amount" => Product::whereIn('id', $request->get('products_id'))->sum('price')
            ];

            $order = Order::create($data);
            $order->products()->sync($request->get('products_id'));

            $order->load(['customer', 'seller', 'products']);

            return $this->prepareResponse($order, "Pedido cadastrado com sucesso!");

        } catch (\Throwable $e) {
            return $this->prepareResponse($request->all(), $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(OrderRequest $request, $id): JsonResponse
    {
        $order = Order::find($id);

        if (!$order) {
            return $this->prepareResponse(null, "Pedido #$id não encontrado.", 404);
        }

        try {

            $data = [
                "seller_id" => $request->get('seller_id'),
                "customer_id" => $request->get('customer_id'),
                "amount" => Product::whereIn('id', $request->get('products_id'))->sum('price')
            ];
            $order->update($data);
            $order->products()->sync($request->get('products_id'));

            $order->load(['customer', 'seller', 'products']);

            return $this->prepareResponse($order, "Pedido atualizado com sucesso!");

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

        $order = Order::find($id);

        if (!$order) {
            return $this->prepareResponse(null, "Pedido #$id não encontrado.", 404);
        }

        try {
            $order->products()->delete();

            $order->delete();

            return $this->prepareResponse($order, "Pedido removido com sucesso!");

        } catch (\Throwable $e) {
            return $this->prepareResponse(["id" => $id], $e->getMessage(), 500);
        }
    }
}
