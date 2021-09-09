<?php

namespace App\Repositories\v1\Interfaces;

interface StockRepositoryInterface
{

    public function getAll(string $query, bool $only_available_stock);

    public function getByType(string $type, string $type_id);

    public function getOneById(string $id);
}
