@extends('layouts.master')
@section('main')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Bem Vindo ao Gerenciador de Notas Fiscais</h1>
                <p class="lead text-muted">Faça o upload do arquivo da nota fiscal. Lembrando que o sistema só aceita upload de aquivos com extensão ".xml"</p>

                <form class="card p-2" enctype="multipart/form-data" id="fileUploadForm">
                    @csrf
                    <div class="input-group">
                        <input id="filepath" type="file" name="filepath" class="form-control">
                        <button id="bt_incluir_arquivo" class="btn btn-secondary"><i class="fas fa-file-upload"></i> Enviar</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div id="retorno"></div>

            <div id="retorno_nota"></div>
        </div>
    </section>

    @section('scripts')
        <script>
            $(document).ready(function($) {
                function salvar(){
                    var flag_arquivo = $("#filepath").val();
                    if(flag_arquivo != ''){
                        var form = $('#fileUploadForm')[0];
                        var data = new FormData(form);
                        $("#bt_incluir_arquivo").prop("disabled", true);
                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            url: "/salvarxml",
                            data: data,
                            processData: false, // impedir que o jQuery tranforma a "data" em querystring
                            contentType: false, // desabilitar o cabeçalho "Content-Type"
                            cache: false, // desabilitar o "cache"
                            timeout: 600000, // definir um tempo limite (opcional)
                            success: function (data) {
                                console.log(data);
                                $("#bt_incluir_arquivo").prop("disabled", false);
                                alert('Nota salva com sucesso');
                                location.reload();
                            },
                            error: function (e) {
                                console.log(e);
                                alert(e.responseJSON.mensagem);
                                $("#bt_incluir_arquivo").prop("disabled", false);
                            }
                        });
                    }else{
                        alert("Escolha um arquivo com a extenção XML e carregue novamente!");
                    }
                }

                $("#bt_incluir_arquivo").click(function(event) {
                    $("#retorno").empty();
                    $("#retorno_nota").empty();

                    event.preventDefault();
                    var flag_arquivo = $("#filepath").val();
                    if(flag_arquivo != ''){
                        var form = $('#fileUploadForm')[0];
                        var data = new FormData(form);
                        $("#bt_incluir_arquivo").prop("disabled", true);
                        $.ajax({
                            type: "POST",
                            enctype: 'multipart/form-data',
                            url: "/uploadxml",
                            data: data,
                            processData: false, // impedir que o jQuery tranforma a "data" em querystring
                            contentType: false, // desabilitar o cabeçalho "Content-Type"
                            cache: false, // desabilitar o "cache"
                            timeout: 600000, // definir um tempo limite (opcional)
                            success: function (data) {
                                $("#bt_incluir_arquivo").prop("disabled", false);
                                if(data.dados.nProt != ''){
                                    $("#retorno").append(
                                        '<div class="alert alert-success" role="alert">Protocolo de autorização: '+data.dados.nProt+'</div>'
                                    );
                                    $("#retorno_nota").append(
                                        '<div class="card">'+
                                            '<div class="card-header">'+
                                                'Nota Fiscal: <b>'+data.dados.nNF+'</b> Emitida em: <b>'+data.dados.dhEmi+'</b>'+
                                            '</div>'+
                                            '<div class="card-body">'+
                                                '<h5 class="card-title">'+data.dados.cliente.xNome+'</h5>'+
                                                '<p class="card-text"><b>CPF: </b>'+data.dados.cliente.CPF+'</br>'+
                                                '<b>Endereço: </b>'+data.dados.cliente.enderDest.xLgr+', n°: '+data.dados.cliente.enderDest.nro+' - Bairro: '+data.dados.cliente.enderDest.xBairro+
                                                    ' '+data.dados.cliente.enderDest.xMun+'/'+data.dados.cliente.enderDest.UF+'</br>'+
                                                '<b>CEP: </b>'+data.dados.cliente.enderDest.CEP+'</br>'+
                                                '<b>Valor total da NF: </b>R$ '+data.dados.valorNF+'</p>'+
                                                '<a class="btn btn-primary" id="bt_salvar"><i class="fas fa-save"></i> Salvar dados</a>'+
                                            '</div>'+
                                        '</div>'
                                    );
                                    $("#bt_salvar").click(function(event) {
                                        salvar();
                                    });
                                }else{
                                    $("#retorno").append(
                                        '<div class="alert alert-danger" role="alert">Protocolo de autorização não informado!</div>'
                                    );
                                }
                                // location.reload();
                            },
                            error: function (e) {
                                if(e.status == 415){
                                    alert('Não foi possivel submeter o arquivo, verifique o formato pois o sistema só aceita arquivos no formato XML!');
                                }else if(e.status == 401){
                                    alert(e.responseJSON.mensagem);
                                }else{
                                    alert('Erro ao submeter o arquvio!');
                                }
                                $("#bt_incluir_arquivo").prop("disabled", false);
                            }
                        });
                    }else{
                        alert("Escolha um arquivo com a extenção XML para fazer o upload!");
                    }
                });
            });
        </script>
    @endsection
@endsection
