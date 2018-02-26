<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EnvioRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Facades\Empresa;
use App\Compra;
use App\Envio;
use App\EnvioItem;

class EnvioCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $empresa = Empresa::get();

        if ($request->ajax()) {
            $envios = Envio::buscar($request->fechaInicial, $request->fechaFinal, $request->store_id)->paginate(5);
            return response()->json(view('inventario.envios.compras.include.tabla', ['envios'=>$envios])->render());
        }

        return view('inventario.envios.compras.index', ['empresa' => $empresa]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.envios.compras.create.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EnvioRequest $request)
    {
        DB::beginTransaction();

        try {
            $envio = new Envio($request->datos);
            $envio->fecha = Carbon::createFromFormat('d/m/Y', $request->datos['fecha']);
            $envio->empresa_id = Empresa::get()->id;
            $envio->save();

            for ($i=0; $i < count($request->items['product_id']); $i++) { 
                $item = new EnvioItem();
                $item->envio_id = $envio->id;
                $item->items_compras_id = $request->items['items_compras_id'][$i];
                $item->product_stock_id = $request->items['product_stock_id'][$i];
                $item->product_id = $request->items['product_id'][$i];
                $item->stock_id = $request->items['stock_id'][$i];
                $item->color = $request->items['color'][$i];
                $item->contidad = $request->items['cantidad'][$i];
                $item->save();
            }

            DB::commit();
            return response()->json(['mensaje' => 'Se ingresó correctamente el registro.']);

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
        $compra = Compra::findOrFail($id);
        $empresa = Empresa::get();

        return view('inventario.envios.compras.enviar.enviar', ['compra' => $compra, 'empresa' => $empresa]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $envio = Envio::findOrFail($id);

        return response()->json(view('inventario.envios.compras.include.tablaVer', ['envio'=>$envio])->render());
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
}
