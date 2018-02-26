<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Requests\MarkRequest;
use App\Http\Controllers\Controller;
use App\ProductMark;
use App\Facades\Empresa;

class MarkController extends Controller
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
        $marcas = ProductMark::buscar($filtro)->paginate(5);

        if ($request->ajax()) {
            return response()->json(view('inventario.configuracion.marca.include.marcas', ['marcas'=>$marcas])->render());
        }

        return view('inventario.configuracion.marca.marca', ['marcas'=>$marcas]);
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
    public function store(MarkRequest $request)
    {
        if ($request->ajax()) {
            $marca = new ProductMark($request->all());
            $marca->empresa_id = Empresa::get()->id;
            $marca->save();

            return response()->json(['mensaje' => 'Se ingresó con éxito el color']);
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
        $marcas = ProductMark::findOrfail($id);

        return response()->json($marcas->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarkRequest $request, $id)
    {
        if ($request->ajax()) {
            $marca = ProductMark::findOrfail($id);
            $marca->fill($request->all());
            $marca->save();

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
        ProductMark::destroy($id);

        return response()->json(['mensaje'=>'Se eliminó correctamente el color']);
    }
}
