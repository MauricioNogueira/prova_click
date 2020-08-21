<?php

namespace App\Http\Controllers;

use App\Helpers\LogError;
use Illuminate\Http\Request;
use App\Services\VendaService;
use App\Services\ClienteService;
use Illuminate\Support\Facades\DB;

class VendaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('area-venda');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $resultVenda = VendaService::store($request->vendas);
            $resultCliente = ClienteService::store($request->cliente);

            if (!$resultVenda || !$resultCliente) {
                DB::rollBack();

                return response()->json([
                    'message' => 'Desculpe, não foi possível efetuar a compra'
                ], 500);
            }

            DB::commit();

            return response()->json([
                'message' => 'Obrigado pela preferência :D'
            ], 200);
        } catch (\Throwable $th) {
            DB::rollBack();
            LogError::registerLog($th);

            return response()->json([
                'message' => 'Falha interna ao efetuar compra'
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function receita()
    {
        try {
            $total = VendaService::getReceita();

            return response()->json([
                'total' => $total
            ], 200);
        } catch (\Throwable $th) {
            LogError::registerLog($th);

            return response()->json([
                'message' => 'Falha ao buscar dados da receita'
            ], 500);
        }
    }

    public function listagem()
    {
        return view('listagem-venda');
    }

    public function getVendas()
    {
        try {
            $listagem = VendaService::getVendas();

            return response()->json($listagem, 200);
        } catch (\Throwable $th) {
            LogError::registerLog($th);

            return response()->json([
                'message' => 'Erro ao buscar dados das vendas'
            ], 500);
        }
    }
}
