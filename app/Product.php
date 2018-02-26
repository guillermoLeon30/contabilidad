<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductCategory;
use App\Facades\Empresa;

class Product extends Model{

    protected $fillable = ['codigo','marca','descripcion','unidades','simbolo'];

    //------------------------------------RELACIONES-----------------------------------
    public function categorias()
    {
        return $this->belongsToMany('App\ProductCategory', 'products_product_categories')->withTimestamps();
    }

    public function dimensiones()
    {
        return $this->hasMany('App\Stock')->orderBy('n_orden', 'asc');
    }

    public function inventarios()
    {
        return $this->belongsToMany('App\Stock', 'product_stock')->withTimestamps();
    }

    public function imagenes()
    {
        return $this->hasMany('App\ProductImage')->orderBy('n_orden', 'asc');
    }

    //----------------------------------------------------------------------------------
    //---------------------------------ALCANCES DE DATOS-------------------------------
    public function scopeBuscar($query, $buscar)
    {
        return $query->where('empresa_id', '=', Empresa::get()->id)
                     ->where(function ($query) use($buscar){
                        $query->where('codigo', 'like', '%'.$buscar.'%')
                              ->orWhere('marca', 'like', '%'.$buscar.'%')
                              ->orWhere('categoria', 'like', '%'.$buscar.'%');
                     });
    }
    //----------------------------------------------------------------------------------
    //------------------------------------METODOS-----------------------------------------
    /**
     * Une todas las categorias 
     *
     * @ArrCategorias  Array
     * @return String
     */
    public function srtCategoria($ArrCategorias)
    {
        $cat = '';

        foreach ($ArrCategorias as $categoria => $id) {
            $cat .= ProductCategory::find($id)->categoria.' ';
        }

        return $cat;
    }

    /**
     * Devuelve un arreglo para ingresar en la tabla product_stock (muchos a muchos)
     *
     * @colores  String
     * @idsStock  Array
     * @return Array
     */
    public function arregloProductStock($color, $idsStock)
    {
        $arr = array();
        
        foreach ($idsStock as $id) {            
            $arr[$id]['color'] = $color;
        }
        
        return $arr;
    }

    /**
     * Devuelve un arreglo con los colores que tiene el producto.
     * Se puede anclar al producto general de la siguiente forma ($producto['colores'] = $producto->colores();)
     *
     * @return Array
     */
    public function colores()
    {
        $colores = $this->belongsToMany('App\Stock', 'product_stock')->withPivot('color')->get();
        
        $colores->transform(function ($producto, $key){
            return $producto->pivot->color;
        });

        return array_unique($colores->all());
    }

}
