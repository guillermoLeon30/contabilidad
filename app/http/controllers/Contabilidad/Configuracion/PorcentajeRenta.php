<?php

namespace App\Http\Controllers\Contabilidad\Configuracion;

use Illuminate\Http\Request;
use App\Http\Requests\RetencionRequest;
use App\Http\Controllers\Controller;
use App\PorcentajeRetencionRenta;

class PorcentajeRenta extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retenciones = PorcentajeRetencionRenta::retenciones()->paginate(5);

        return response()->json(
            view('contabilidad.configuracion.include.tablaRenta', ['retencionesRenta'=>$retenciones])->render());
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
    public function store(RetencionRequest $request)
    {
        $retencion = new PorcentajeRetencionRenta($request->all());
        $retencion->porcertaje = $request->porcentaje;
        $retencion->save();

        return response()->json(['mensaje' => 'Se ingresó correctamente el registro.']);
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
        $retencion = PorcentajeRetencionRenta::findOrFail($id);

        return response()->json(['retencion' => $retencion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RetencionRequest $request, $id)
    {
        $retencion = PorcentajeRetencionRenta::findOrFail($id);
        $retencion->fill($request->all());
        $retencion->porcertaje = $request->porcentaje;
        $retencion->save();
        
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
        PorcentajeRetencionRenta::destroy($id);

        return response()->json(['mensaje' => 'Se elimió correctamente el registro.']);
    }
}
