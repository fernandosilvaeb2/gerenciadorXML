@extends('layouts.master')
@section('main')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light">Gerenciador de Notas Fiscais</h1>
                <div class="card">
                    <div class="card-header">
                      Notas Fiscais Salvas
                    </div>
                    <div class="card-body">
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
                                @if ($notas)
                                    @foreach ($notas as $item)
                                        <tr>
                                            <td>{{$item->nf}}</td>
                                            <td>{{$item->cliente->nome}}</td>
                                            <td>{{$item->cliente->cpf}}</td>
                                            <td>R$ {{$item->valor}}</td>
                                            <td>{{ date_create($item->dt_emissao)->format('d-m-Y H:i:s') }}</td>
                                            <td><a href="/notas/{{$item->nf}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td>
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
