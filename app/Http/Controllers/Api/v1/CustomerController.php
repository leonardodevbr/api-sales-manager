<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CustomerController extends Controller
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

        $customers = Customer::orderBy($sortBy, $orderBy)
            ->simplePaginate($limit);

        if ($customers->isEmpty()) {
            return $this->prepareResponse(null, "Nenhum cliente cadastrado.", 404);
        }

        return $this->prepareResponse($customers, "Lista de clientes.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return $this->prepareResponse(null, "Cliente #$id não encontrado.", 404);
        }

        return $this->prepareResponse($customer, "Dados do cliente #$id.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CustomerRequest $request
     * @return JsonResponse
     */
    public function store(CustomerRequest $request): JsonResponse
    {
        try {

            $customer = Customer::create($request->all());

            return $this->prepareResponse($customer, "Cliente cadastrado com sucesso!");

        } catch (\Throwable $e) {
            return $this->prepareResponse($request->all(), $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CustomerRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(CustomerRequest $request, $id): JsonResponse
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return $this->prepareResponse(null, "Cliente #$id não encontrado.", 404);
        }

        try {

            $customer->update($request->all());

            return $this->prepareResponse($customer, "Cliente atualizado com sucesso!");

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

        $customer = Customer::find($id);

        if (!$customer) {
            return $this->prepareResponse(null, "Cliente #$id não encontrado.", 404);
        }

        try {

            $customer->delete();

            return $this->prepareResponse($customer, "Cliente removido com sucesso!");

        } catch (\Throwable $e) {
            return $this->prepareResponse(["id" => $id], $e->getMessage(), 500);
        }
    }
}
