<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductDataRequest;
use App\Http\Requests\ProductColorRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Facades\Empresa;
use App\Product;
use App\ProductMark;
use App\ProductUnitMeasure;
use App\ProductCategory;
use App\Color;
use App\Stock;

class ProductController extends Controller
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
            $productos = Product::buscar($filtro)->get()->take(20);
            $productos->each(function ($producto, $key){
                $producto->imagenes;
            });

            return response()->json(['productos' => $productos]);
        }

        $page = $request->page;
        $productos = Product::buscar($filtro)->paginate(5);
        $productos->each(function ($producto, $key){
            return $producto->imagenes;
        });
        
        if ($request->ajax()) {
            return response()->json(
                view('inventario.producto.index.include.productos', ['productos'=>$productos])->render());
        }

        return view('inventario.producto.index.index', ['productos'=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $marcas = ProductMark::buscar('')->get();
        $unidades = ProductUnitMeasure::buscar('')->get();
        $categorias = ProductCategory::buscar('')->get();
        $colores = Color::buscar('')->get();

        if ($request->ajax()) {
            return response()->json(['marcas'       =>  $marcas,
                                     'unidades'     =>  $unidades,
                                     'categorias'   =>  $categorias,
                                     'colores'      =>  $colores]);
        }

        return view('inventario.producto.create.create', ['marcas'     => $marcas,
                                                          'unidades'   => $unidades,
                                                          'categorias' => $categorias,
                                                          'colores'    => $colores]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $cont = 1;
        $idsStock = array();
        
        DB::beginTransaction();

        try {
            $producto = new Product($request->all());
            $producto->categoria = $producto->srtCategoria($request->categorias);
            $producto->empresa_id = Empresa::get()->id;
            $producto->save();

            $producto->categorias()->attach($request->categorias);

            foreach ($request->dimensiones as $dimension) {
                $stock = new Stock();
                $stock->product_id = $producto->id;
                $stock->n_orden = $cont;
                $cont++;
                $stock->dimension = $dimension;
                $stock->save();
                array_push($idsStock, $stock->id);
            }
            
            foreach ($request->colores as $color) {
                $producto->inventarios()->attach($producto->arregloProductStock($color, $idsStock));
            }
            
            DB::commit();

            return response()->json(['mensaje' => 'Se ingresó correctamente el producto.']);
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
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {

            $producto = Product::findOrFail($id);
            $producto->categorias;
            $producto['colores'] = $producto->colores();
            $producto->dimensiones;
            $producto->imagenes;

            return response()->json(['producto' =>  $producto]);
        }
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
    public function update(ProductDataRequest $request, $id)
    {
        if ($request->ajax()) {
            DB::beginTransaction();

            try {
                $producto = Product::findOrFail($id);
                $producto->fill($request->all());
                $producto->categoria = $producto->srtCategoria($request->categorias);
                $producto->save();

                $producto->categorias()->sync($request->categorias);

                DB::commit();

                return response()->json(['mensaje'  => 'Se actualizó correctamente el producto.']);
            } catch (\Exception $e) {
                DB::rollBack();

                return response()->json([],500);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateColors(ProductColorRequest $request, $id)
    {
        DB::beginTransaction();
        
        try {
            $producto = Product::findOrFail($id);
            $arrIdsStock = $producto->dimensiones->pluck('id')->all();

            $producto->inventarios()->attach($producto->arregloProductStock($request->color, $arrIdsStock));
            $colores = $producto->colores();
            DB::commit();
            
            return response()->json(['mensaje'  => 'Se actualizó correctamente el producto.',
                                     'colores'  => $colores]);

        } catch (\Exception $e) {
            DB::rollBack();

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

    /**
     * Retorna un html de tipo <select> para las marcas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comboBoxMarca(Request $request)
    {
        if ($request->ajax()) {
            $marcas = ProductMark::buscar('')->get();

            return response()->json(
                view('inventario.producto.create.include.cbMarca', ['marcas' => $marcas])->render());
        }
    }

    /**
     * Retorna un html de tipo <select> para las unidades.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comboBoxUnidad(Request $request)
    {
        if ($request->ajax()) {
            $unidades = ProductUnitMeasure::buscar('')->get();

            return response()->json(
                view('inventario.producto.create.include.cbUnidad', ['unidades' => $unidades])->render());
        }
    }

    /**
     * Retorna un html de tipo <select> para las unidades.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function comboBoxCategoria(Request $request)
    {
        if ($request->ajax()) {
            $categorias = ProductCategory::buscar('')->get();

            return response()->json(
                view('inventario.producto.create.include.cbCategoria', ['categorias' => $categorias])->render());
        }
    }

    public function comboBoxColor(Request $request)
    {
        if ($request->ajax()) {
            $colores = Color::buscar('')->get();

            return response()->json(
                view('inventario.producto.create.include.cbColor', ['colores' => $colores])->render());
        }
    }
}
