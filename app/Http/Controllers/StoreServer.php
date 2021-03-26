<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NotaFiscal;
use App\Models\Cliente;

class StoreServer extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        // $NotaFiscal = new NotaFiscal();
        // $Cliente    = new Cliente();
        $dados = $request->all();
        if (isset($dados['filepath'])) {
            $file = $dados['filepath'];
            if($file->extension() == 'xml'){
                $data = file_get_contents($file);
                $xml = simplexml_load_string($data);
                if(isset($xml->NFe)){
                    if((string)$xml->NFe->infNFe->emit->CNPJ == "09066241000884"){
                        if((string)$xml->protNFe->infProt->nProt != ""){
                            $n_f = trim((string)$xml->NFe->infNFe->ide->nNF);
                            $flag_nota = NotaFiscal::where('nf',$n_f)->first();
                            if(!$flag_nota){
                                $flag_cliente = Cliente::where('cpf',trim((string)$xml->NFe->infNFe->dest->CPF))->first();
                                if(!$flag_cliente){
                                    $dadosCliente['cpf'] = (string)$xml->NFe->infNFe->dest->CPF;
                                    $dadosCliente['nome'] = (string)$xml->NFe->infNFe->dest->xNome;
                                    $dadosCliente['logradouro'] = (string)$xml->NFe->infNFe->dest->enderDest->xLgr;
                                    $dadosCliente['numero'] = (string)$xml->NFe->infNFe->dest->enderDest->nro;
                                    $dadosCliente['bairro'] = (string)$xml->NFe->infNFe->dest->enderDest->xBairro;
                                    $dadosCliente['municipio'] = (string)$xml->NFe->infNFe->dest->enderDest->xMun;
                                    $dadosCliente['uf'] = (string)$xml->NFe->infNFe->dest->enderDest->UF;
                                    $dadosCliente['cep'] = (string)$xml->NFe->infNFe->dest->enderDest->CEP;

                                    $respCliente = Cliente::create($dadosCliente);
                                    if($respCliente){
                                        $dadosNota['nf'] = (string)$xml->NFe->infNFe->ide->nNF;
                                        $dadosNota['dt_emissao'] = date("Y-m-d H:i:s", strtotime((string)$xml->NFe->infNFe->ide->dhEmi));
                                        $dadosNota['id_cliente'] = $respCliente->id;
                                        $dadosNota['valor'] = (string)$xml->NFe->infNFe->total->ICMSTot->vNF;
                                        $dadosNota['protocolo_autorizacao'] = (string)$xml->protNFe->infProt->nProt;
                                        $respNota = NotaFiscal::create($dadosNota);
                                    }else{
                                        return response()->json(['success' => false], 500);
                                    }
                                }else{
                                    $dadosNota['nf'] = (string)$xml->NFe->infNFe->ide->nNF;
                                    $dadosNota['dt_emissao'] = date("Y-m-d H:i:s", strtotime((string)$xml->NFe->infNFe->ide->dhEmi));
                                    $dadosNota['id_cliente'] = $flag_cliente->id;
                                    $dadosNota['valor'] = (string)$xml->NFe->infNFe->total->ICMSTot->vNF;
                                    $dadosNota['protocolo_autorizacao'] = (string)$xml->protNFe->infProt->nProt;
                                    $respNota = NotaFiscal::create($dadosNota);
                                    return response()->json(['success' => true], 200);
                                }
                                return response()->json(['success' => true], 200);
                            }else{
                                return response()->json(['success' => false,'mensagem'=>"Nota já existe no sistema!"], 401);
                            }
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
