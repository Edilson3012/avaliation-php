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
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="card-header">
                                <h5 class="title">Listagem de Entregas</h5>
                            </div>
                            <div class="col-4 text-left">
                                <a href="{{ route('delivery.create') }}" class="btn btn-sm btn-primary">Add Entrega</a>
                                <button class="btn btn-sm btn-warning btnFilter" id="btnFilter"
                                    onclick="showHideDiv()">Filtrar</button>
                            </div>
                        </div>
                        {{-- <div class="form-control"> --}}
                        <div class="card-header">
                            <form action="{{ route('delivery.search') }}" class="form" method="POST">
                                @csrf
                                <div class="div-filters" style="display: none">

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="title">Título</label>
                                            <input type="text" value="{{ $filters['title'] ?? old('title') }}" class="form-control" name="title" id="title">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="completed">Entregue?</label>
                                            <select id="completed" name="completed" class="form-control">
                                                <option value="">Selecione...</option>
                                                <option value="0">Sim</option>
                                                <option value="1">Não</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">

                                        <label for="">De: </label>
                                        <input type="datetime-local" id="date_start" class="form-control"
                                            value="{{ $filters['date_start'] ?? old('date_start') }}" name="date_start">
                                        <label for="">Até: </label>
                                        <input type="datetime-local" id="date_end" class="form-control"
                                            value="{{ $filters['date_end'] ?? old('date_end') }}" name="date_end">
                                    </div>
                                    <button type="submit" class="btn btn-primary "><i class="nc-icon nc-zoom-split"></i>
                                        Pesquisar</button>
                                </div>
                            </form>
                        </div>
                        {{-- </div> --}}
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center table-flush">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Título</th>
                                            <th scope="col">Prazo Entrega</th>
                                            <th scope="col">Entregue?</th>
                                            <th scope="col">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deliveries as $delivery)
                                            <tr>
                                                <td>{{ $delivery->title }}</td>
                                                <td>{{ formatDateAndTime($delivery->deadline, 'd/m/Y H:i') }}
                                                </td>
                                                <td>
                                                    {{ $delivery->completed === 1 ? 'Sim' : 'Não' }}
                                                </td>
                                                <td>
                                                    <a href="{{ route('delivery.edit', $delivery->id) }}"
                                                        class="alert alert-info" onclick="editConfirm('{{$delivery->completed}}')" ><i class="nc-icon nc-ruler-pencil"></i></a>

                                                    <button class="alert alert-danger"
                                                        onclick="deleteConfirmation('{{ $delivery->id }}', '{{ $delivery->completed }}')">
                                                        <i class="nc-icon nc-simple-remove"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

<script type="text/javascript">
    var showDiv = false;

    function showHideDiv() {
        if (showDiv == false) {
            $('.div-filters').show();
            showDiv = true;
        } else {
            $('.div-filters').hide();
            showDiv = false;
        }
    }

    function verifyDelivery(completed) {
        if (completed == 1) {
            swal({
                title: "Atenção!",
                text: "Entrega concluída não pode ser excluída!",
                icon: "error",
                button: "Ok!",
                dangerMode: true,
            });
            return true;
        }
    }

    function editConfirm(completed) {

        if (verifyDelivery(completed)) {
            return false;
        }
    }

    function deleteConfirmation(id, completed) {

        if (verifyDelivery(completed)) {
            return false;
        }

        swal({
            title: "Vai excluir mesmo?",
            text: "Deseja realmente excluir este registro?",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Sim, tenho certeza!",
            cancelButtonText: "Ops, vou não!",
            reverseButtons: !0
        }).then(function(e) {

            if (e.value === true) {

                $.ajax({
                    type: 'DELETE',
                    url: `delivery/${id}`,
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: 'JSON',
                    success: function(results) {

                        if (results.success === true) {
                            swal("Feito!", results.message, "success");
                            location.reload();
                        } else {
                            swal("Ops!", results.message, "error");
                        }
                    }
                });

            } else {
                // demo.showNotification('top','right', 'asdasds');
                iziToast.info({
                    title: 'INFO',
                    message: 'Registro não foi excluído.',
                    icon: '',
                    iconText: '',
                    iconColor: '',
                    iconUrl: null,
                    position: 'topRight', // bottomRight, bottomLeft, topRight,
                });
            }

        }, function(dismiss) {
            return false;
        })
    }
</script>
