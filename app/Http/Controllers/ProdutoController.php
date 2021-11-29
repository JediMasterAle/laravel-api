<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdutoResource;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtos = Produto::paginate(15);
        return ProdutoResource::collection($produtos);
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
            $produto = Produto::create([
                'nome' => $request->nome,
                'quantidade' => $request->quantidade
            ]);
            return new ProdutoResource($produto);
        } catch (\Throwable $th) {
            return json_encode($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function show(Produto $produto)
    {
        return new ProdutoResource($produto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {
        try {
            $update = $produto->update([
                'nome' => $request->nome,
                'quantidade' => $request->quantidade
            ]);

            return new ProdutoResource($produto);
        } catch (\Throwable $th) {
            return json_encode($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produto  $produto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        try {
            $produto->delete();
            return 'Deletado com sucesso';
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
