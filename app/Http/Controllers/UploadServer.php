<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadServer extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $dados = $request->all();
        if (isset($dados['filepath'])) {
            $file = $dados['filepath'];
            if($file->extension() == 'xml'){
                $data = file_get_contents($file);
                $xml = simplexml_load_string($data);
                if(isset($xml->NFe)){
                    if((string)$xml->NFe->infNFe->emit->CNPJ == "09066241000884"){
                        if((string)$xml->protNFe->infProt->nProt != ""){
                            $dados['nProt'] = (string)$xml->protNFe->infProt->nProt;
                            $dados['nNF'] = (string)$xml->NFe->infNFe->ide->nNF;
                            $dados['dhEmi'] = date("d-m-Y H:i:s", strtotime((string)$xml->NFe->infNFe->ide->dhEmi));
                            $dados['cliente'] = $xml->NFe->infNFe->dest;
                            $dados['valorNF'] = (string)$xml->NFe->infNFe->total->ICMSTot->vNF;
                        }else{
                            $dados['nProt'] = "";
                        }
                        return response()->json(['success' => true,"dados" => $dados], 200);
                    }else{
                        return response()->json(['success' => false,'mensagem'=>"CNPJ não autorizado!"], 401);
                    }
                }else{
                    if((string)$xml->infNFe->emit->CNPJ == "09066241000884"){
                        if((string)$xml->protNFe->infProt->nProt != ""){
                            $dados['nProt'] = (string)$xml->protNFe->infProt->nProt;
                            $dados['nNF'] = (string)$xml->infNFe->ide->nNF;
                            $dados['dhEmi'] = date("d-m-Y H:i:s", strtotime((string)$xml->infNFe->ide->dhEmi));
                            $dados['cliente'] = $xml->infNFe->dest;
                            $dados['valorNF'] = (string)$xml->infNFe->total->ICMSTot->vNF;
                        }else{
                            $dados['nProt'] = "";
                        }
                        return response()->json(['success' => true,"dados" => $dados], 200);
                    }else{
                        return response()->json(['success' => false,'mensagem'=>"CNPJ não autorizado!"], 401);
                    }
                }
            }else{
                return response()->json(['success' => false], 415);
            }
        } else {
            return response()->json(['success' => false], 415);
        }
    }
}
