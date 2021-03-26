@extends('layouts.master')
@section('main')
    <section class="py-5 container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light text-center ">Gerenciador de Notas Fiscais</h1>
                <div class="card">
                    <div class="card-header text-center ">
                      Cliente {{$cliente->nome}}
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>Endereço</th>
                                <th>CEP</th>
                                <th>CPF</th>
                                <th>Municipio</th>
                                <th>UF</th>
                            </thead>
                            <tbody>
                                @if ($cliente)
                                        <tr>
                                            <td>{{$cliente->logradouro}}, n°: {{$cliente->numero}} - {{$cliente->bairro}}</td>
                                            <td>{{$cliente->cep}}</td>
                                            <td>{{$cliente->cpf}}</td>
                                            <td>{{$cliente->municipio}}</td>
                                            <td>{{$cliente->uf}}</td>
                                        </tr>
                                @else
                                    <tr>
                                        <td colspan="4">Nenhuma cliente Localizado!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                        <table class="table table-bordered">
                            <thead>
                                <th>NF</th>
                                <th>Cliente</th>
                                <th>CPF</th>
                                <th>Valor</th>
                                <th>Data Emissao</th>
                                <th>Opções</th>
                            </thead>
                            <tbody>
                                @if ($cliente->notas)
                                    @foreach ($cliente->notas as $item)
                                        <tr>
                                            <td>{{$item->nf}}</td>
                                            <td>{{$item->cliente->nome}}</td>
                                            <td>{{$item->cliente->cpf}}</td>
                                            <td>R$ {{$item->valor}}</td>
                                            <td>{{ date_create($item->dt_emissao)->format('d-m-Y H:i:s') }}</td>
                                            <td class="text-center"><a href="/notas/{{$item->nf}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Nenhuma Nota Fiscal Localizada!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <a href="/clientes" class="btn btn-sm btn-primary">Voltar</a>
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
                $("#link_clientes").addClass('active');
            });
        </script>
    @endsection
@endsection
