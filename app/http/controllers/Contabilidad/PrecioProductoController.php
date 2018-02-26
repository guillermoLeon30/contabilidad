<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;
use App\Http\Requests\PrecioMenorRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Facades\Empresa;
use App\Stock;

class PrecioProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(PrecioMenorRequest $request)
    {
        DB::beginTransaction();

        try {
            foreach ($request->dimensiones as $id) {
                $dimension = Stock::findOrFail($id);
                $dimension->fill($request->precio);
                $dimension->save();
            }
            
            DB::commit();
            return response()->json(['mensaje' => 'Se ingreso el precio correctamente']);

        } catch (\Exception $e) {
            
            DB::rollBack();
            return response()->json([], 500);
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

    /**
     * Retorna vista Precio producto por menor
     *
     * @return \Illuminate\Http\Response
     */
    public function precioPorMenor()
    {
        return view('contabilidad.precio.menor.menor', ['empresa' => Empresa::get()]);
    }

    /**
     * Retorna vista Precio producto por mayor
     *
     * @return \Illuminate\Http\Response
     */
    public function precioPorMayor()
    {
        return view('contabilidad.precio.mayor.mayor', ['empresa' => Empresa::get()]);
    }
}
