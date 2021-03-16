@extends('layouts.android.master')

@section('link')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('script')
    <!-- InputMask -->
    <script src="{{ asset('adminlte/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/inputmask/min/jquery.inputmask.bundle.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        });
        $('[data-mask]').inputmask();
    </script>
@endsection

@section('content')

    <div class="row">
        <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-shopping-bag"></i></span>

                <div class="info-box-content">
                    <span class="info-box-text">Pedidos</span>
                    <span class="info-box-number">{{ $pedidos->count() }}</span>
                </div>
                <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card card-navy">
                <div class="card-header">
                    <h3 class="card-title">Lista de tus Pedidos</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <ul class="nav nav-pills flex-column">
                        @foreach ($pedidos as $pedido)
                            @php($i++)
                            <li class="nav-item active">
                                <a href="
                                    @if ($pedido->estatus == 0)
                                    {{ route('android.checkout', Auth::user()->id) }}
                                    @else
                                    {{ route('android.pedidos.show', [Auth::user()->id, $pedido->id]) }}
                                    @endif
                                    " class="nav-link">
                                    {{--<i class="fas fa-flag"></i>--}}
                                    {{ $i }}.- Pedido <b>#{{ $pedido->id }}</b>
                                    <small> ({{ haceCuanto($pedido->created_at) }})</small>
                                    <span class="float-right">
                                        @if ($pedido->estatus == 0)
                                            <span class="badge bg-warning">Pendiente de Pago</span>
                                        @endif
                                        @if ($pedido->estatus == 1)
                                            <span class="badge bg-info">En Espera</span>
                                        @endif
                                </span>

                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
        {{--<div class="col-12">
            <div class="card card-navy">
                <div class="card-header">
                    <h3 class="card-title">N° Familias por Municipios</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-0" style="display: block;">
                    <ul class="nav nav-pills flex-column">
                        @foreach ($municipios as $municipio)
                        <li class="nav-item active">
                            <a href="#" class="nav-link">
                                --}}{{--<i class="fas fa-flag"></i>--}}{{-- {{ $municipio->nombre_completo }}
                                <span class="badge bg-warning float-right">12</span>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <!-- /.card-body -->
            </div>
        </div>--}}
    </div>


@endsection
