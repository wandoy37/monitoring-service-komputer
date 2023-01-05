@extends('admin.layouts.app')

@section('title', 'Service')

@section('content')

    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">Service</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="icon-wrench"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('service.index') }}">Service</a>
                </li>
            </ul>
        </div>

        {{-- Notify --}}
        <div id="flash" data-flash="{{ session('success') }}"></div>

        <div class="row">
            <div class="col-lg-12 mt-4">
                <a href="{{ route('service.create') }}" class="btn btn-secondary btn-round btn-lg">
                    <i class="fas fa-plus"></i>
                    Service
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mt-4">
                <form action="/admin/service">
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
                        <div class="col-sm-4">
                            <div class="form-group form-inline">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="start_date" name="start_date"
                                        placeholder="Start Date ..." value="{{ $filters['start_date'] }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                <strong class="mx-2">To</strong>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="end_date" name="end_date"
                                        placeholder="End Date ..." value="{{ $filters['end_date'] }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
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
                                <a href="{{ route('service.index') }}" class="btn btn-success">Clear</a>
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
                                <th scope="col">Store / Cabang</th>
                                <th scope="col">Nama Pelanggan</th>
                                <th scope="col">Nomor Hp</th>
                                <th scope="col">Perangkat</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 0; ?>
                            @foreach ($services as $service)
                                <?php $no++; ?>
                                <tr class="text-center">
                                    <td>{{ $no }}</td>
                                    <td>{{ $service->code_service }}</td>
                                    <td>{{ $service->store }}</td>
                                    <td>{{ $service->customer_name }}</td>
                                    <td>{{ $service->customer_phone }}</td>
                                    <td>{{ $service->device }}</td>
                                    <td>
                                        @if ($service->status_service == 'registration')
                                            <span
                                                class="text-capitalize badge badge-danger">{{ $service->status_service }}</span>
                                        @endif
                                        @if ($service->status_service == 'check')
                                            <span
                                                class="text-capitalize badge badge-warning">{{ $service->status_service }}</span>
                                        @endif
                                        @if ($service->status_service == 'repair')
                                            <span
                                                class="text-capitalize badge badge-warning">{{ $service->status_service }}</span>
                                        @endif
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
                                                class="text-capitalize badge badge-count">{{ $service->status_service }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-inline">
                                            <form id="form-delete-{{ $service->id }}"
                                                action="{{ url("/admin/service/$service->id/delete") }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <a href="{{ url('admin/service/' . $service->id . '/edit') }}"
                                                class="btn btn-primary btn-link">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a type="button" href="{{ route('resi.view', $service->id) }}"
                                                class="btn btn-link btn-info" target="_blank">
                                                <i class="fas fa-print"></i>
                                            </a>
                                            <a href="{{ route('service.repair', $service->id) }}"
                                                class="btn btn-link btn-warning">
                                                <i class="icon-wrench"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-link"
                                                onclick="btnDelete( {{ $service->id }} )">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
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
    <script>
        $('#start_date').datetimepicker({
            format: 'YYYY-MM-DD',
        });

        $('#end_date').datetimepicker({
            format: 'YYYY-MM-DD',
        });
    </script>
@endpush
