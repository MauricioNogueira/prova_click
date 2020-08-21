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

            $quantidadeTotal = 0;
            $valorTotal = 0;

            foreach ($vendas as $key => $venda) {
                $fruta = $frutas->where('nome', $key)->first();
                $valorTotal += $venda['valor_total'];

                if ($fruta->quantidade >= intval($venda['quantidade'])) {
                    $fruta->quantidade -= intval($venda['quantidade']);
                    $fruta->save();

                    $quantidadeTotal += intval($venda['quantidade']);
                } else {
                    return false;
                }
            }
            Venda::create([
                'quantidade_fruta' => $quantidadeTotal,
                'valor' => $valorTotal,
                'data' => date('Y-m-d')
            ]);

            return true;
        } catch (Throwable $th) {
            LogError::registerLog($th);

            return false;
        }
    }

    public static function getReceita()
    {
        try {
            $receita = Venda::all()->sum('valor');

            return $receita;
        } catch (\Throwable $th) {
            LogError::registerLog($th);

            return [];
        }
    }
}
