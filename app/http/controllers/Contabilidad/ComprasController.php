<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;
use App\Http\Requests\CompraRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Facades\Empresa;
use App\Compra;
use App\ItemsCompra;
use App\CuentaPorPagar;
use App\Pago;

class ComprasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $compras = Compra::buscar($request->fechaInicial, $request->fechaFinal, $request->provider_id)->paginate(5);

            if (isset($request->envio)) {
                return response()->json(view('inventario.envios.compras.create.include.tabla', ['compras'=>$compras])->render());
            }

            return response()->json(view('contabilidad.compras.include.tabla', ['compras'=>$compras])->render());
        }

        return view('contabilidad.compras.compras');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $empresa = Empresa::get();
        $empresa->retencionesIva;
        $empresa->retencionesRenta;
        $empresa->tipoDePagos;

        return view('contabilidad.compras.create.create', ['empresa' => $empresa]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompraRequest $request)
    {
        $arrIdProducto = $request->items['idProducto'];
        $arrIdStock = $request->items['idStock'];
        $arrColor = $request->items['color'];
        $arrPrecioProducto = $request->items['precio'];
        $arrCantProducto = $request->items['cantProducto'];
        $longitudArrItem = count($arrIdProducto);

        $arrfecha = $request->pagos['fecha'];
        $arrIdTipoPago = $request->pagos['idTipoPago'];
        $arrDocPago = $request->pagos['numDocPago'];
        $arrmontoPago = $request->pagos['montoPago'];
        $logitudArrFecha = count($arrfecha);

        DB::beginTransaction();

        try {
            $IdEmpresa = Empresa::get()->id;
            $compra = new Compra($request->compra);
            $compra->empresa_id = $IdEmpresa;
            $compra->fecha_compra = Carbon::createFromFormat('d/m/Y', $request->compra['fecha_compra']);
            $compra->save();

            for ($i=0; $i < $longitudArrItem; $i++) { 
                $item = new ItemsCompra();
                $item->compra_id = $compra->id;
                $item->product_stock = $compra->idProductStock($arrIdProducto[$i], $arrIdStock[$i], $arrColor[$i]);
                $item->precio = $arrPrecioProducto[$i];
                $item->cantidad = $arrCantProducto[$i];
                $item->save();
            }

            $ctaXPagar = new CuentaPorPagar($request->cuentaXPagar);
            $ctaXPagar->empresa_id = $IdEmpresa;
            $ctaXPagar->compra_id = $compra->id;
            $ctaXPagar->provider_id = $request->compra['provider_id'];
            $ctaXPagar->fecha_vencimiento = Carbon::createFromFormat('d/m/Y', $request->cuentaXPagar['fecha_vencimiento']);
            $ctaXPagar->save();

            for ($i=0; $i < $logitudArrFecha; $i++) { 
                $pago = new Pago();
                $pago->cuentas_por_pagar_id = $ctaXPagar->id;
                $pago->fecha = Carbon::createFromFormat('d/m/Y', $arrfecha[$i]);
                $pago->cls_pagos_id = $arrIdTipoPago[$i];
                $pago->numero_documento = (is_null($arrDocPago[$i]))?0:$arrDocPago[$i];
                $pago->total = $arrmontoPago[$i];
                $pago->estado = 'A_pagar';
                $pago->save();
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

        return response()->json(view('contabilidad.compras.include.tablaVer', ['compra'=>$compra])->render());
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
        $compra = Compra::findOrFail($id);
        
        if ($compra->envios->count() > 0) {
            return response()->json(['mensaje' => 'No se puede eliminar la compra existen articulos enviados.'], 500);
        }else{
            DB::beginTransaction();

            try {
                Pago::destroy($compra->CuentaPorPagar->first()->pagos->pluck('id')->all());
                $compra->CuentaPorPagar->first()->delete();
                ItemsCompra::destroy($compra->items->pluck('id')->all());
                $compra->delete();
                     
                DB::commit();

                return response()->json(['mensaje' => 'Se eliminó correctamente el registro.'], 200);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json(['mensaje' => 'No se puede eliminar ocurrio un error.'], 500);
            }
        }
    }
}
