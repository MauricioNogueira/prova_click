<?php

namespace App\Http\Controllers;

use App\Fruta;
use Throwable;
use App\Helpers\LogError;
use Illuminate\Http\Request;
use App\Http\Requests\CreateFruitRequest;

class FrutaController extends Controller
{
    public function index()
    {
        return view('home');
    }

    public function create()
    {
        return view('cadastra-fruta');
    }

    public function store(CreateFruitRequest $request)
    {
        try {
            Fruta::create($request->all());

            return redirect()->route('fruta.create')->with([
                'success' => "{$request->get('nome')} foi salvo!"
            ]);
        } catch (Throwable $th) {
            LogError::registerLog($th);
            $exception = 'Houve um erro interno ao salvar';

            return redirect()->route('fruta.create')->with([
                'exception' => $exception
            ]);
        }
    }

    public function fruitList(Request $request)
    {
        try {
            $search = $request->get('search') ?? null;

            $frutas = Fruta::where('nome', 'like', "%$search%")
                ->select('id', 'nome as text')->get();

            return response()->json($frutas, 200);
            // dd($frutas, $request->all());
        } catch (Throwable $th) {
            LogError::registerLog($th);

            return response()->json([], 500);
        }
    }
}
