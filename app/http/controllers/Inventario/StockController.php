<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Requests\StockRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Stock;
use App\Product;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StockRequest $request)
    {
        DB::beginTransaction();

        try {
            $stock = new Stock($request->all());
            $stock->n_orden = $stock->numeroDeOrden($request->product_id);
            $stock->save();
            
            $producto = Product::findOrFail($request->product_id); 
            $colores = $producto->colores();

            foreach ($colores as $color) {
                $producto->inventarios()->attach($stock->id, ['color' => $color]);
            }
            $producto->dimensiones;
            DB::commit();

            return response()->json(['mensaje' => 'Se ingresó correctamente la dimensión.',
                                     'producto' =>  $producto]);
        } catch (\Exception $e) {
            DB::rollBack();
            
            return response()->json(['mensaje' => 'Ocurrio un error en la conexión.'], 500);
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
        DB::beginTransaction();

        try {
            $dimension = Stock::findOrFail($id);
            $numeroDeOrdenActual = array_get($dimension, 'n_orden');
            $dimensiones = $dimension->producto->dimensiones;
            $ultimoNumeroDeOrden = array_get($dimensiones->last(), 'n_orden');

            if ($request->mover == 'abajo' && $numeroDeOrdenActual > 1) {
                $numeroDeOrdenAnterior = $numeroDeOrdenActual - 1;
                $dimensionAnterior = $dimensiones->where('n_orden', $numeroDeOrdenAnterior)->first();
                $dimension->n_orden = $numeroDeOrdenAnterior;
                $dimensionAnterior->n_orden = $numeroDeOrdenActual;
                
                $dimension->save();
                $dimensionAnterior->save();
                DB::commit();

                return response()->json(['mensaje' => 'Se ingresó correctamente la dimensión.']);

            } elseif ($request->mover == 'arriba' && $numeroDeOrdenActual < $ultimoNumeroDeOrden) {
                $numeroDeOrdenSiguiente = $numeroDeOrdenActual + 1;
                $dimensionSiguiente= $dimensiones->where('n_orden', $numeroDeOrdenSiguiente)->first();
                $dimension->n_orden = $numeroDeOrdenSiguiente;
                $dimensionSiguiente->n_orden = $numeroDeOrdenActual;

                $dimension->save();
                $dimensionSiguiente->save();
                DB::commit();

                return response()->json(['mensaje' => 'Se ingresó correctamente la dimensión.']);
            }else{
                DB::commit();
            }    
        } catch (\Exception $e) {
            DB:rollBack();
            return response()->json([], 500);            
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
