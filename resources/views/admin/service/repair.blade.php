@extends('admin.layouts.app')

@section('title', 'Repair')

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
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('service.repair', $service->id) }}">Repair</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12 mt-4">
                <a href="{{ route('service.index') }}" class="btn btn-secondary btn-round btn-border btn-lg">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>

        {{-- Notify --}}
        <div id="flash" data-flash="{{ session('success') }}"></div>

        <div class="row mt-4">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="page-title">Device Information</h4>
                    </div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td width="20%" class="font-weight-bold">Device <small>(Perangkat)</small></td>
                                    <td>: {{ $service->device }}</td>
                                </tr>
                                <tr>
                                    <td width="20%" class="font-weight-bold">Keluhan</td>
                                    <td>: {{ $service->keluhan }}</td>
                                </tr>
                                <tr>
                                    <td width="20%" class="font-weight-bold">Current Status <small>(Status saat
                                            ini)</small></td>
                                    <td>:
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
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col lg-6">
                <h2>Service Activity</h2>
                <div class="my-4">
                    <a href="{{ route('create.activity', $service->id) }}" class="btn btn-secondary btn-round">
                        <i class="fas fa-plus"></i>
                        Activity
                    </a>
                    <div class="my-2">
                        <ol class="activity-feed">
                            <li class="feed-item feed-item-info">
                                <time class="date" datetime="9-25">{{ $service->created_at->format('M d') }}</time>
                                <span class="text"><b>Registration</b>
                                    <p>Perangkat anda sedang dalam antrian</p>
                                </span>
                            </li>
                            @foreach ($service->activities as $activity)
                                <li class="feed-item feed-item-info">
                                    <time class="date" datetime="9-25">{{ $activity->created_at->format('M d') }}</time>
                                    <span class="text-capitalize"><b>{{ $activity->status }}</b>
                                        <p>{{ $activity->description }}</p>
                                    </span>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
            <div class="col lg-6">
                <h2>Addtional Item</h2>
                <div class="my-4">
                    <a href="{{ route('create.additional.item', $service->id) }}" class="btn btn-secondary btn-round">
                        <i class="fas fa-plus"></i>
                        Item
                    </a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-head-bg-secondary">
                                <thead>
                                    <tr class="text-center">
                                        <th scope="col">Item</th>
                                        <th scope="col">Price (Rp)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($service->additionals as $additional_item)
                                        <tr class="text-center">
                                            <td>{{ $additional_item->item }}</td>
                                            <td>@currency($additional_item->price)</td>
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
    {{-- <script>
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
    </script> --}}
@endpush
