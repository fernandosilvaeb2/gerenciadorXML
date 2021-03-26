<?php

namespace App\Http\Controllers;

use App\Models\NotaFiscal;
use Illuminate\Http\Request;

class NotaFiscalController extends Controller
{
    public function index()
    {
        $data['notas'] = NotaFiscal::with('cliente')->get();
        return view('notas')->with($data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($nf)
    {
        $data['nota'] = NotaFiscal::with('cliente')->where('nf',$nf)->first();
        $data['id_nota'] = $nf;
        return view('nota')->with($data);
    }

    public function edit(NotaFiscal $notaFiscal)
    {
        //
    }

    public function update(Request $request, NotaFiscal $notaFiscal)
    {
        //
    }

    public function destroy(NotaFiscal $notaFiscal)
    {
        //
    }
}
