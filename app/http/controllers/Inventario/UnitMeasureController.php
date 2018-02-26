<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Requests\UnitRequest;
use App\Http\Controllers\Controller;
use App\ProductUnitMeasure;
use App\Facades\Empresa;

class UnitMeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $page = $request->page;
        $unidades = ProductUnitMeasure::buscar($filtro)->paginate(5);

        if ($request->ajax()) {
            return response()->json(
                view('inventario.configuracion.unidad.include.unidades', ['unidades'=>$unidades])->render());
        }

        return view('inventario.configuracion.unidad.unidad', ['unidades'=>$unidades]);
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
    public function store(UnitRequest $request)
    {
        if ($request->ajax()) {
            $unidad = new ProductUnitMeasure($request->all());
            $unidad->empresa_id = Empresa::get()->id;
            $unidad->save();

            return response()->json(['mensaje' => 'Se ingresó correctamente la unidad de medida']);
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unidad = ProductUnitMeasure::findOrFail($id);

        return response()->json($unidad->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UnitRequest $request, $id)
    {
        if ($request->ajax()) {
            $unidad = ProductUnitMeasure::findOrFail($id);
            $unidad->fill($request->all());
            $unidad->save();

            return response()->json(['mensaje' => 'Se actualizó correctamente la unidad de medida']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ProductUnitMeasure::destroy($id);


        return response()->json(['mensaje'=>'Se eliminó correctamente la unidad']);
    }
}
