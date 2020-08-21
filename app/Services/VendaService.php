<?php

namespace App\Services;

use App\Fruta;
use App\Venda;
use Throwable;
use App\Helpers\LogError;

class VendaService
{
    public static function store(Array $vendas)
    {
        try {
            $nomeFrutas = collect($vendas)->pluck('nome')->toArray();
            $vendas = collect($vendas)->keyBy('nome')->toArray();

            $frutas = Fruta::whereIn('nome', $nomeFrutas)->get();
            
            foreach ($vendas as $key => $venda) {
                $fruta = $frutas->where('nome', $key)->first();
                if ($fruta->quantidade >= intval($venda['quantidade'])) {
                    $fruta->quantidade -= intval($venda['quantidade']);
                    $fruta->save();

                    Venda::create([
                        'quantidade_fruta' => $venda['quantidade'],
                        'valor' => $venda['valor_total'],
                        'data' => date('Y-m-d')
                    ]);
                } else {
                    return false;
                }
            }

            return true;
        } catch (Throwable $th) {
            LogError::registerLog($th);

            return false;
        }
    }
}