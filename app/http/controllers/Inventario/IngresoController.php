<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Requests\BodegaIngresoRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\BodegaIngreso;
use Carbon\Carbon;

class IngresoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventario.ingreso.index.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventario.ingreso.create.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BodegaIngresoRequest $request)
    {
        dump($request->all());
        
        $arrIdProducto = $request->items['idProducto'];
        $arrIdStock = $request->items['idStock'];
        $arrColor = $request->items['color'];
        $arrCantProducto = $request->items['cantProducto'];

        $arrIngresos = array();
        $arrProductStockId = array();

        for ($i=0; $i < count($arrIdProducto); $i++) { 
            $ingreso = new BodegaIngreso();
            $ingreso->fecha = Carbon::createFromFormat('d/m/Y', $request->datos['fecha']);
            $ingreso->envio_id = $request->datos['envio_id'];
            $ingreso->product_stock_id = $ingreso->idProductStock($arrIdProducto[$i], $arrIdStock[$i], $arrColor[$i]);
            $ingreso->product_id = $arrIdProducto[$i];
            $ingreso->stock_id = $arrIdStock[$i];
            $ingreso->color = $arrColor[$i];
            $ingreso->contidad = $arrCantProducto[$i];
            $arrIngresos[] = $ingreso;
            $arrProductStockId[] = $ingreso->product_stock_id;
        }

        $store = Auth::user()->stores->first();
        $arrProductStock = $store->arrProductStock($arrProductStockId, $arrCantProducto, $request->datos['ubicacion']);

        DB::beginTransaction();
        try {
            $store->ingresos()->saveMany($arrIngresos);
            $store->productStocks()->syncWithoutDetaching($arrProductStock);

            DB::commit();

            return response()->json(['mensaje' => 'Se ingresó correctamente el registro.'], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['mensaje' => 'Ocurrio un problema en la conexión'], 500);
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
}
