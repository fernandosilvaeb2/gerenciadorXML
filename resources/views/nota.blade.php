@extends('layouts.master')
@section('main')
    <section class="py-5  container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light text-center">Gerenciador de Notas Fiscais</h1>
                <div class="card">
                    <div class="card-header">
                        @if ($nota)
                            <b>Nota Fiscal:</b> {{$nota->nf}} <b>Emitida em:</b> {{ date_create($nota->dt_emissao)->format('d-m-Y H:i:s') }}
                        @else
                            Nenhuma Nota Fiscal localizada para a pesquisa: {{$id_nota}}!
                        @endif
                    </div>
                    <div class="card-body">
                        @if ($nota)
                            <b>Nome: </b>{{$nota->cliente->nome}}<br>
                            <b>CPF: </b>{{$nota->cliente->cpf}}<br>
                            <b>Endereço: </b>{{$nota->cliente->logradouro}}, <b>n°: </b> {{$nota->cliente->numero}} <br>
                            <b>Bairro</b> {{$nota->cliente->bairro}}, <br>
                            <b>Cidade/UF: </b>{{$nota->cliente->municipio}}/{{$nota->cliente->uf}} <br>
                            <b>CEP: </b> {{$nota->cliente->cep}}<br>
                            <b>Valor: </b>R$ {{$nota->valor}}
                        @else
                            <b>Nenhuma Nota Localiza!</b>
                        @endif
                    </div>
                    <div class="card-footer">
                        <a href="/notas" class="btn btn-sm btn-primary">Voltar</a>
                    </div>
                  </div>
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
                $.each($('.active'), function (index, val) {
                    $(this).removeClass('active');
                });
                $("#link_notas").addClass('active');
            });
        </script>
    @endsection
@endsection
