<?php

namespace App\Http\Controllers\Contabilidad;

use Illuminate\Http\Request;
use App\Http\Requests\ContactoProveedorRequest;
use App\Http\Controllers\Controller;
use App\ProviderContact;

class ContactoProveedorController extends Controller
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
    public function store(ContactoProveedorRequest $request)
    {
        $contacto = ProviderContact::create($request->all());

        return response()->json(['mensaje' => 'Se ingreso correctamente el registro.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $filtro = (isset($request->filtro) && !empty($request->filtro))?$request->filtro:'';
        $page = (isset($request->page) && !empty($request->page))?$request->page:1;

        $contactos = ProviderContact::buscar($filtro, $id)->paginate(5);
        
        if ($request->ajax()) {
            return response()->json(
                view('contabilidad.compras.proveedores.contactos.include.tabla', 
                    ['contactos'=>$contactos, 'idProveedor'=>$id])->render());
        }

        return view('contabilidad.compras.proveedores.contactos.contactos', 
            ['contactos'=>$contactos, 'idProveedor'=>$id]);
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
        ProviderContact::destroy($id);

        return response()->json(['mensaje' => 'Se eliminó correctamente el registro.']);
    }
}
