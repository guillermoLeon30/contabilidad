<?php

namespace App\Http\Controllers\Contabilidad\Configuracion;

use Illuminate\Http\Request;
use App\Http\Requests\ClsPagosRequest;
use App\Http\Controllers\Controller;
use App\ClsPago;

class clsPagosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagos = ClsPago::ClsPagos()->paginate(5);

        return response()->json(
            view('contabilidad.configuracion.include.tablaPagos', ['pagos'=>$pagos])->render());
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
    public function store(ClsPagosRequest $request)
    {
        ClsPago::create($request->all());

        return response()->json(['mensaje' => 'Se ingresó el registro correctamente.']);
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
        $pago = ClsPago::findOrFail($id);

        return response()->json(['pago' => $pago]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ClsPagosRequest $request, $id)
    {
        $pago = ClsPago::findOrFail($id);
        $pago->fill($request->all());
        $pago->save();

        return response()->json(['mensaje' => 'Se ingresó correctamente el registro.']);
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
