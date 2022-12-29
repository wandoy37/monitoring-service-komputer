@extends('admin.layouts.app')

@section('title', 'Detail Service')

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
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('transaction.show', $service->id) }}">Detail Service</a>
                </li>
            </ul>
        </div>

        {{-- Notify --}}
        <div id="flash" data-flash="{{ session('success') }}"></div>

        <div class="row">
            <div class="col-lg-12 mt-4">
                <a href="{{ route('transaction.index') }}" class="btn btn-outline-secondary btn-round">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Code Service</label>
                                    <br>
                                    <h4>{{ $service->code_service }}</h4>
                                </div>
                                <div class="form-group">
                                    <label>Date Registration</label>
                                    <br>
                                    <h4>{{ $service->created_at->format('d-M-Y') }}</h4>
                                </div>
                                <div class="form-group">
                                    <label>Customer Name</label>
                                    <br>
                                    <h4>{{ $service->customer_name }}</h4>
                                </div>
                                <div class="form-group">
                                    <label>Customer Phone</label>
                                    <br>
                                    <h4>{{ $service->customer_phone }}</h4>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Toko / Cabang</label>
                                    <br>
                                    <h4>{{ $service->store }}</h4>
                                </div>
                                <div class="form-group">
                                    <label>Keluhan</label>
                                    <br>
                                    <h4>{{ $service->keluhan }}</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="table-responsive">
                                <table class="table table-hover table-head-bg-secondary">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">Item or Service</th>
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
                                        <tr class="text-center bg-secondary text-light">
                                            <td><b>TOTAL</b></td>
                                            <td colspan="2"><b>@currency($totals)</b></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('transaction.store', $service->id) }}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Kategori Service</label>
                                        <select class="form-control" name="category">
                                            <option value="">-- Select Category --</option>
                                            @foreach ($categories as $key => $value)
                                                <option value="{{ $key }}"
                                                    {{ old('category') == $key ? 'selected' : null }}>
                                                    {{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <span class="text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Keterangan <i>(Optional)</i></label>
                                        <textarea name="description" class="form-control" rows="2"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Total Bayar</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">Rp</span>
                                            </div>
                                            <input type="text" name="total_price" class="form-control"
                                                value="{{ $totals }}">
                                        </div>
                                        @error('total_price')
                                            <span class="text-danger">*{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group float-right">
                                        <button style="submit" class="btn btn-success btn-round">
                                            <i class="icon-basket"></i>
                                            Bayar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
