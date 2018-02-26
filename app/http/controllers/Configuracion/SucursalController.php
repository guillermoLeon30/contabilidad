<?php

namespace App\Http\Controllers\Configuracion;

use Illuminate\Http\Request;
use App\http\Requests\SucursalRequest;
use App\http\Requests\ActualizarSucursalRequest;
use App\Http\Controllers\Controller;
use App\Store;
use App\Facades\Empresa;
use Illuminate\Support\Facades\DB;

class SucursalController extends Controller
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
        $sucursales = Store::buscar($filtro)->paginate(5);

        if ($request->ajax()) {
            return response()->json(
                view('configuracion.sucursal.include.sucursales', ['sucursales' => $sucursales])->render());
        }

        return view('configuracion.sucursal.sucursal', ['sucursales' => $sucursales]);
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
    public function store(SucursalRequest $request)
    {
        if ($request->ajax()) {
            if ($request->tipo == 'Sucursal') {
                $store = new Store($request->all());
                $store->codigo_local_factura = $store->codigoFactura();
                $store->empresa_id = Empresa::get()->id;
                $store->save();

                return response()->json(['mensaje' => 'Se ingresó correctamente la sucursal']);
            }else{
                DB::transaction(function () use($request){
                    $tienda = new Store($request->all());
                    $tienda->cambiarMatrizASucursal();
                    $tienda->codigo_local_factura = $tienda->codigoFactura();
                    $tienda->empresa_id = Empresa::get()->id;
                    $tienda->save();
                });

                return response()->json(['mensaje' => 'Se ingresó correctamente la sucursal']);
            }
            
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
        $sucursal = Store::findOrFail($id);

        return response()->json($sucursal->toArray());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ActualizarSucursalRequest $request, $id)
    {
        if ($request->ajax()) {
            $sucursal = Store::findOrFail($id);
            if (($sucursal->tipo == 'Sucursal' && $request->tipo == 'Sucursal') || 
                    ($sucursal->tipo == 'Matriz' && $request->tipo == 'Matriz')) {
                $sucursal->fill($request->all());
                $sucursal->save();

                return response()->json(['mensaje' => 'Se ingresó correctamente la sucursal']);
            }

            if ($sucursal->tipo == 'Sucursal' && $request->tipo == 'Matriz'){
                 DB::transaction(function () use($request, $sucursal){
                    $sucursal->cambiarMatrizASucursal();
                    $sucursal->fill($request->all());
                    $sucursal->save();
                });

                return response()->json(['mensaje' => 'Se ingresó correctamente la sucursal']);
            }
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
        //
    }
}
