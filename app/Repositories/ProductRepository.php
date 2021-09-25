<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getByNameOrReference($query)
    {
        try {
            return $this->product->where('name','LIKE','%'.$query.'%')
                ->orWhere('reference','LIKE','%'.$query.'%')->get();
        } catch (\Throwable $th) {
            return json_encode (['error' => true , 'message' => 'Erro ao obter dados do produto. Detalhe: ' . $th]  );
        }   
    }

    public function getAll()
    {
        try {
            return $this->product->all();
        } catch (\Throwable $th) {
            return json_encode (['error' => true , 'message' => 'Erro ao obter listagem geral de produtos. Detalhe: ' . $th]  );
        } 
    }

    public function store($request){
        try {
            $this->product->create($request);
            return json_encode (['success' => true , 'message' => 'Produto cadastrado com sucesso']  );
        } catch (\Throwable $th) {
            return json_encode (['error' => true , 'message' => 'Erro ao cadastrar produto']  );
        }
    }

    public function show($id)
    {
        try {
            $this->product->findOrFail($id);
            return json_encode (['success' => true ]  );
        } catch (\Throwable $th) {
            return json_encode (['error' => true , 'message' => 'Erro ao tentar exibir produto. Detalhe:' . $th->getMessage()]  );
        }
    }

    public function update($request, $id){
        try {
            $product = $this->product->find($id);
            $request->update($request);
            $product->save();
            return json_encode (['success' => true, 'message' => 'Produto atualizado com sucesso'] );
        } catch (\Throwable $th) {
            return json_encode (['error' => true , 'message' => 'Erro ao tentar atualizar produto. Detalhe:' . $th->getMessage()]  );
        }
    }

    public function destroy($id)
    {
        try {
            $product = $this->product->find($id);
            $product->delete();
            return json_encode (['success' => true, 'message' => 'Produto excluido com sucesso'] );
        } catch (\Throwable $th) {
            return json_encode (['error' => true , 'message' => 'Erro ao tentar excluir produto. Detalhe:' . $th->getMessage()]  );
        }
    }

}