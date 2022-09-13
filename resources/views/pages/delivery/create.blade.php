@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'delivery',
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                @include('pages.includes.alerts')

                <div class="card">

                    <form class="col-md-12" action="{{ route('delivery.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="card-header border-0">
                            <div class="row align-items-center">
                                <div class="card-header">
                                    <h5 class="title">Cadastrar Entrega</h5>
                                </div>
                                <div class="col-4 text-left">
                                    <button type="submit" id="btnSalvar"
                                        class="btn btn-success">{{ __('Salvar') }}</button>
                                </div>
                            </div>
                            <div class="card-body">
                                @include('pages.delivery._partials.form')
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
