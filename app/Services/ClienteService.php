<?php

namespace App\Services;

use Throwable;
use App\Cliente;
use App\Helpers\LogError;

class ClienteService
{
    public static function store(Array $cliente)
    {
        try {
            $cliente['data_compra'] = date('Y-m-d');

            $result = Cliente::create($cliente);

            return true;
        } catch (Throwable $th) {
            LogError::registerLog($th);

            return false;
        }
    }
}