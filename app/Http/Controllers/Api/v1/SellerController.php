<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SellerRequest;
use App\Models\Seller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
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

        $sellers = Seller::with('user')
            ->orderBy($sortBy, $orderBy)
            ->simplePaginate($limit);

        if ($sellers->isEmpty()) {
            return $this->prepareResponse(null, "Nenhum vendedor cadastrado.", 404);
        }

        return $this->prepareResponse($sellers, "Lista de vendedores.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $seller = Seller::with('user')
            ->find($id);

        if (!$seller) {
            return $this->prepareResponse(null, "Vendedor #$id não encontrado.", 404);
        }

        return $this->prepareResponse($seller, "Dados do vendedor #$id.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SellerRequest $request
     * @return JsonResponse
     */
    public function store(SellerRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();

            $user = User::create([
                "email" => $request->get("email"),
                "password" => Hash::make($request->get("password"))
            ]);

            if ($user->save()) {

                $seller = Seller::create(array_merge(["user_id" => $user->id], $request->all()));

                DB::commit();

                $seller->load('user');

                return $this->prepareResponse($seller, "Vendedor cadastrado com sucesso!");

            } else {
                DB::rollBack();
                return $this->prepareResponse($request->all(), "Ocorreu um erro ao salvar os dados do vendedor!");
            }

        } catch (\Throwable $e) {
            return $this->prepareResponse($request->all(), $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param SellerRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(SellerRequest $request, $id): JsonResponse
    {
        $seller = Seller::find($id);

        if (!$seller) {
            return $this->prepareResponse(null, "Vendedor #$id não encontrado.", 404);
        }

        try {

            $seller->update($request->all());

            $seller->load('user');

            return $this->prepareResponse($seller, "Vendedor atualizado com sucesso!");

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

        $seller = Seller::find($id);

        if (!$seller) {
            return $this->prepareResponse(null, "Vendedor #$id não encontrado.", 404);
        }

        try {

            $user = $seller->user;

            $seller->delete();

            $user->delete();

            return $this->prepareResponse($seller, "Vendedor removido com sucesso!");

        } catch (\Throwable $e) {
            return $this->prepareResponse(["id" => $id], $e->getMessage(), 500);
        }
    }
}