@extends('layouts.master')
@section('main')
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-12 col-md-8 mx-auto">
                <h1 class="fw-light">Gerenciador de Notas Fiscais</h1>
                <div class="card">
                    <div class="card-header">
                      Clientes
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <th>Nome</th>
                                <th>CPF</th>
                                <th>Municipio</th>
                                <th>UF</th>
                                <th>Opções</th>
                            </thead>
                            <tbody>
                                @if ($clientes)
                                    @foreach ($clientes as $item)
                                        <tr>
                                            <td>{{$item->nome}}</td>
                                            <td>{{$item->cpf}}</td>
                                            <td>{{$item->municipio}}</td>
                                            <td>{{$item->uf}}</td>
                                            <td><a href="/clientes/{{$item->id}}" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="6">Nenhuma cliente Localizado!</td>
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
                $("#link_clientes").addClass('active');
            });
        </script>
    @endsection
@endsection
