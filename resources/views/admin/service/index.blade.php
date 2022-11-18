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
            <div class="col-lg-12 mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ url('/admin/service') }}">
                            <div class="form-group">
                                <div class="input-icon">
                                    <input type="text" name="search" class="form-control" placeholder="Code Service..."
                                        value="{{ $search }}">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ url('/admin/service') }}">
                            <div class="form-group form-show-validation row">
                                <label class="col-lg-2 col-md-2 col-sm-3 mt-sm-2 text-right">Status</label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <select class="form-control" name="status">
                                        <option value="">-- Select Status --</option>
                                        @foreach ($statuses as $key => $value)
                                            <option value="{{ $key }}" class="text-capitalize"
                                                {{ old('role', $status) == $key ? 'selected' : null }}>
                                                {{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-secondary btn-sm">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
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
                                                class="text-capitalize badge badge-success">{{ $service->status_service }}</span>
                                        @endif
                                        @if ($service->status_service == 'cancle')
                                            <span
                                                class="text-capitalize badge badge-danger">{{ $service->status_service }}</span>
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
                                            <a href="{{ route('resi.view', $service->id) }}"
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
