<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $data['clientes'] = Cliente::with('notas')->get();
        return view('clientes')->with($data);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $data['cliente'] = Cliente::with('notas')->where('id',$id)->first();
        $data['id_cliente'] = $id;
        return view('cliente')->with($data);
    }


    public function edit(Cliente $cliente)
    {
        //
    }


    public function update(Request $request, Cliente $cliente)
    {
        //
    }


    public function destroy(Cliente $cliente)
    {
        //
    }
}
