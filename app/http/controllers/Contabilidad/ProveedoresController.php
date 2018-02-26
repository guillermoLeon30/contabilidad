<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;
use App\Http\Requests\ProveedorRequest;
use App\Http\Controllers\Controller;
use App\Facades\Empresa;
use App\Provider;

class ProveedoresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';

        if (isset($request->todos)) {
            $proveedores = Provider::buscar($filtro)->get()->take(20);

            return response()->json(['proveedores' => $proveedores]);
        }

        $page = (isset($request->page) && !empty($request->page))?$request->page:1;
        $proveedores = Provider::buscar($filtro)->paginate(5);

        if ($request->ajax()) {
            return response()->json(
                view('contabilidad.compras.proveedores.include.tabla', ['proveedores' => $proveedores])->render());
        }

        return view('contabilidad.compras.proveedores.proveedores', ['proveedores' => $proveedores]);
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
    public function store(ProveedorRequest $request)
    {
        $proveedor = new Provider($request->all());
        $proveedor->empresa_id = Empresa::get()->id;
        $proveedor->save();

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
        $proveedor = Provider::findOrFail($id);

        return response()->json(['proveedor' => $proveedor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProveedorRequest $request, $id)
    {
        $proveedor = Provider::findOrFail($id);
        $proveedor->fill($request->all());
        $proveedor->save();

        return response()->json(['mensaje' => 'Se editó correctamente el registro.']);
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
