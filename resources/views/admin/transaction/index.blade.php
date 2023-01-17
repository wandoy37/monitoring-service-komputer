@extends('admin.layouts.app')

@section('title', 'Service')

@section('content')

    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Transaction</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-basket"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transaction.index') }}">Transaction</a>
                </li>
            </ul>
        </div>

        {{-- Notify --}}
        <div id="flash" data-flash="{{ session('success') }}"></div>

        <div class="row">
            <div class="col-lg-12 mt-4">
                <form action="/admin/transaction">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <div class="input-icon">
                                    <input type="text" name="search" class="form-control" placeholder="Serach ..."
                                        value="{{ $filters['search'] }}">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select class="form-control" name="store">
                                    <option value="">-- Select Store --</option>
                                    @foreach ($stores as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $filters['store'] == $key ? 'selected' : null }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('store')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group">
                                <select class="form-control" name="status">
                                    <option value="">-- Select Status --</option>
                                    @foreach ($statuses as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ $filters['status'] == $key ? 'selected' : null }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('store')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-gorup" style="margin-top:10px;">
                                <button type="submit" class="btn btn-secondary">
                                    <i class="fa fa-search"></i>
                                    Filter
                                </button>
                                <a href="{{ route('transaction.index') }}" class="btn btn-success">Clear</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-hover table-head-bg-secondary">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">#</th>
                                <th scope="col">Kode Servis</th>
                                <th scope="col">Store (Cabang)</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Perangkat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($services as $service)
                                <tr class="text-center">
                                    <td>{{ $services->count() * ($services->currentPage() - 1) + $loop->iteration }}</td>
                                    <td>{{ $service->code_service }}</td>
                                    <td>{{ $service->store }}</td>
                                    <td>{{ $service->customer_name }}</td>
                                    <td>{{ $service->device }}</td>
                                    <td>
                                        @if ($service->status_service == 'done')
                                            <span
                                                class="text-capitalize badge badge-primary">{{ $service->status_service }}</span>
                                        @endif
                                        @if ($service->status_service == 'paid')
                                            <span
                                                class="text-capitalize badge badge-success">{{ $service->status_service }}</span>
                                        @endif
                                        @if ($service->status_service == 'cancle')
                                            <span
                                                class="text-capitalize badge badge-info">{{ $service->status_service }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($service->status_service == 'done')
                                            <a type="button" href="{{ route('transaction.show', $service->id) }}"
                                                class="btn btn-secondary btn-round">
                                                <i class="icon-basket"></i>
                                                Bayar
                                            </a>
                                        @else
                                            <a type="button" href="{{ route('transaction.cetak', $service->id) }}"
                                                class="btn btn-round btn-outline-info" target="_blank">
                                                <i class="fas fa-print"></i>
                                                Cetak
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-12 d-flex justify-content-center">
                <div class="my-2">
                    {!! $services->appends(request()->all())->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>

    </div>

@endsection

@push('scripts')
    {{-- Notify Success --}}
    <script>
        var flash = $('#flash').data('flash');
        if (flash) {
            $.notify({
                // options
                icon: 'fas fa-check',
                title: 'Success',
                message: '{{ session('success') }}',
            }, {
                // settings
                type: 'success'
            });
        }
    </script>

    {{-- SweetAlert Confirmation --}}
    <script>
        function btnDelete(id) {
            swal({
                title: 'Apa anda yakin?',
                text: "Data tidak dapat di kembalikan setelah ini !!!",
                type: 'warning',
                buttons: {
                    confirm: {
                        text: 'Ya, hapus sekarang',
                        className: 'btn btn-success'
                    },
                    cancel: {
                        visible: true,
                        className: 'btn btn-danger'
                    }
                }
            }).then((Delete) => {
                if (Delete) {
                    $('#form-delete-' + id).submit();
                } else {
                    swal.close();
                }
            });
        }
    </script>
@endpush
