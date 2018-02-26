<?php

namespace App\Http\Controllers\inventario;

use Illuminate\Http\Request;
use App\Http\Requests\colorRequest;
use App\Http\Controllers\Controller;
use App\Color;
use App\Facades\Empresa;

class ColorController extends Controller
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
        $colores = Color::buscar($filtro)->paginate(5);

        if ($request->ajax()) {
            return response()->json(view('inventario.configuracion.color.include.colores', ['colores'=>$colores])->render());
        }

        return view('inventario.configuracion.color.color', ['colores'=>$colores]);
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
    public function store(colorRequest $request)
    {
        if ($request->ajax()) {
            $color = new Color($request->all());
            $color->empresa_id = Empresa::get()->id;
            $color->save();
            
            return  response()->json([
                'mensaje' => 'Se ingresó con éxito el color'
            ]);
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
        $color = Color::findOrFail($id);

        return response()->json($color->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(colorRequest $request, $id)
    {
        if ($request->ajax()) {
            $color = Color::findOrFail($id);
            $color->fill($request->all());
            $color->save();

            return response()->json(['mensaje'=>'Se actualizó correctamente el registro']);
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
        Color::destroy($id);

        return response()->json(['mensaje'=>'Se eliminó correctamente el color']);
    }
}
