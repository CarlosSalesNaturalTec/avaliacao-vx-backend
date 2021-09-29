<?php

namespace App\Services;

use App\Repositories\SaleRepository;

class SaleService
{

    private $saleRepositoriy;

    public function __construct(SaleRepository $saleRepositoriy)
    {
        $this->saleRepositoriy = $saleRepositoriy;
    }

    public function index($request)
    {
        if (isset($request->per_page))
            $per_page = $request->per_page;
        else
            $per_page = 20;

        return $this->saleRepositoriy->index($per_page);
    }

    public function store($request)
    {
        return $this->saleRepositoriy->store($request);
    }

    public function show($id)
    {
        return $this->saleRepositoriy->show($id);
    }

    public function update($request, $id)
    {
        return $this->saleRepositoriy->update($request, $id);
    }

    public function destroy($id)
    {
        return $this->saleRepositoriy->destroy($id);
    }
}
