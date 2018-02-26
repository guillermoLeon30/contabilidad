<?php

namespace App\Http\Controllers\Inventario;

use Illuminate\Http\Request;
use App\Http\Requests\ProductImageRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Image;
use File;
use App\Product;
use App\ProductImage;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
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
    public function store(ProductImageRequest $request)
    {
        $file = $request->file('imagen');

        $image = Image::make($file);
        $image->resize(420, null, function ($c){
           $c->aspectRatio();
           $c->upsize();
        });

        $ImagenProducto = new ProductImage($request->all());
        $ImagenProducto->n_orden = $ImagenProducto->numeroDeOrden();
        $ImagenProducto->nombre = $file->hashName();
        $ImagenProducto->imagen = (String) $image->encode('data-url');
        $ImagenProducto->save();

        return response()->json(['mensaje'=>'Se ingresó correctamente la imagen.']);
    }

    /**
     * Display all images of product.
     *
     * @param  int  $id of product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $producto = Product::findOrFail($id);
        $producto->imagenes;
        $producto['colores'] = $producto->colores();

        if ($request->ajax()) {
            return response()->json(
                view('inventario.producto.imagenes.include.imagenes', ['producto' => $producto])->render());
        }

        return view('inventario.producto.imagenes.show', ['producto' => $producto]);
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
            $imagen = ProductImage::findOrFail($id);
            $numeroDeOrdenActual = $imagen->n_orden;
            $imagenes = $imagen->producto->imagenes;
            $ultimaImagen = $imagenes->last();

            $ubicacion = $imagenes->search(function ($imagen, $key) use($id){
                            return $imagen->id == $id;
                        });

            if ($request->mover == 'abajo' && $ubicacion > 0) {
                $anterior = $imagenes[$ubicacion-1];
                $numeroDeOrdenAnterior = $anterior->n_orden;

                $imagen->n_orden = $numeroDeOrdenAnterior;
                $anterior->n_orden = $numeroDeOrdenActual;
                $imagen->save();
                $anterior->save();

                DB::commit();
                return response()->json([]);

            }elseif ($request->mover == 'arriba' && $ultimaImagen->id != $id) {
                $siguiente = $imagenes[$ubicacion+1];
                $numeroDeOrdenSiguiente = $siguiente->n_orden;

                $imagen->n_orden = $numeroDeOrdenSiguiente;
                $siguiente->n_orden = $numeroDeOrdenActual;
                $imagen->save();
                $siguiente->save();

                DB::commit();

                return response()->json([]);
            }else{
                DB::commit(); 
                return response()->json([]);
            }
            
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
        $Imagen = ProductImage::findOrFail($id);
        $ruta = $Imagen->ruta;
        
        $Imagen->delete();

        File::Delete('storage/'.$ruta);

        return response()->json([], 200);
    }
}
