@extends('layouts.app', [
    'class' => '',
    'elementActive' => 'delivery',
])

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">

                        <form class="col-md-12" action="{{ route('delivery.update', $delivery->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row align-items-center">
                                <div class="card-header">
                                    <h5 class="title">Editar Entrega</h5>
                                </div>

                                <div class="col-4 text-left">
                                    <button type="submit" class="btn btn-success">{{ __('Save Changes') }}</button>
                                </div>

                            </div>
                            <div class="card-body">
                                @include('pages.delivery._partials.form')
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
