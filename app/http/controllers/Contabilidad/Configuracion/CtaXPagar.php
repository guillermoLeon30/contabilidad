<?php

namespace App\Http\Controllers\Contabilidad\Configuracion;

use Illuminate\Http\Request;
use App\Http\Requests\ClsCtasXPagarRequest;
use App\Http\Controllers\Controller;
use App\Facades\Empresa;
use App\ClsCtaXPagar;

class CtaXPagar extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ctasXPagar = ClsCtaXPagar::ClsCtasXPagar()->paginate(5);

        return response()->json(
            view('contabilidad.configuracion.include.tablaCtaxXPagar', ['ctasXPagar'=>$ctasXPagar])->render());
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
    public function store(ClsCtasXPagarRequest $request)
    {
        ClsCtaXPagar::create($request->all());

        return response()->json(['mensaje' => 'Se ingreó correctamente el registro.']);
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
        $cuenta = ClsCtaXPagar::findOrFail($id);

        return response()->json(['cuenta' => $cuenta]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClsCtasXPagarRequest $request, $id)
    {
        $cuenta = ClsCtaXPagar::findOrFail($id);
        $cuenta->fill($request->all());
        $cuenta->save();

        return response()->json(['mensaje' => 'Se ingreó correctamente el registro.']);
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
}
