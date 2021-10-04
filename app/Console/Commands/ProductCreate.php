<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class ProductCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {name : Nome do Produto} {reference=000 : Referencia} {price=10 : Preco} {delivery_days=1 : Dias Entrega}';
    private $product;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cadastra Novo Produto';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Product $product)
    {
        parent::__construct();
        $this->product = $product;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   
        try {
            
            $productRequest = $this->mountRequest($this->arguments());
            $response = $this->product->create($productRequest);
            $idProduct = json_decode($response)->id;

            return $this->warn("Comando executado com sucesso: Id do Produto:" . $idProduct);

        } catch (\Throwable $th) {
            return $this->error("Erro ao executar comando:" . $th->getMessage());
        }
    }

    private function mountRequest($arguments){

        $product = $arguments['name'];

        $reference = $arguments['reference'];
        if ($reference == "000") {
            $reference = "Ref_" . $product;
        }

        $price = $arguments['price'];
        $delivery_days = $arguments['delivery_days'];

        return [
            'name' => $product,
            'reference' => $reference,
            'price' => $price,
            'delivery_days' => $delivery_days,
        ];
    }

}
