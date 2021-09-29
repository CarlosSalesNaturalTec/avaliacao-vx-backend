<?php

namespace App\Repositories;

use App\Models\Sale;
use Carbon\Carbon;

class SaleRepository
{
    private $sale;

    public function __construct(Sale $sale)
    {
        $this->sale = $sale;
    }

    public function index($per_page)
    {
        try {
            return $this->sale->with('products:name,delivery_days')->paginate($per_page);
        } catch (\Throwable $th) {
            return ['error' => true , 'message' => 'Erro ao tentar exibir Listagem de Vendas. Detalhe:' . $th->getMessage()];
        }
    }

    public function store($request)
    {
        try {
            $sale = $this->sale;
            $sale->purchase_at = Carbon::parse($request->purchase_at);
            $sale->amount = $request->amount;
            $sale->delivery_days = $request->delivery_days;
            $sale->save();
            $sale->products()->sync($request->products);
            return ['success' => true , 'message' => 'Venda cadastrada com sucesso!'];
        } catch (\Throwable $th) {
            return ['error' => true , 'message' => 'Erro ao tentar salvar Venda. Detalhe:' . $th->getMessage()];
        }
    }

    public function show($id)
    {
        try {
            return $this->sale->with('products:name,delivery_days')->find($id);
        } catch (\Throwable $th) {
            return ['error' => true , 'message' => 'Erro ao tentar exibir Venda. Detalhe:' . $th->getMessage()];
        }
    }

    public function update($request, $id)
    {
        try {
            $sale = $this->sale->find($id);
            $sale->purchase_at = Carbon::parse($request->purchase_at);
            $sale->save();
            $sale->products()->sync($request->products);
            return ['success' => true , 'message' => 'Venda Alterada com sucesso!'];
        } catch (\Throwable $th) {
            return ['error' => true , 'message' => 'Erro ao tentar alterar venda. Detalhe:' . $th->getMessage()];
        }
    }

    public function destroy($id)
    {
        try {
            $sale = $this->sale->find($id);
            $sale->products()->detach();
            $sale->delete();
            return ['success' => true , 'message' => 'Venda Excluída com sucesso!'];
        } catch (\Throwable $th) {
            return ['error' => true , 'message' => 'Erro ao tentar excluir venda. Detalhe:' . $th->getMessage()];
        }
    }

}