<?php 

namespace App\Funciones;

use Illuminate\Support\Facades\Auth;

class Empresa
{
	
	public function get()
	{
		return Auth::user()->empresas()->first();
	}
}