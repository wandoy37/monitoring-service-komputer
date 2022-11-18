@extends('admin.layouts.app')

@section('title', 'User')

@section('content')

    <div class="page-inner">
        <div class="page-header">
            <h4 class="page-title">User</h4>
            <ul class="breadcrumbs">
                <li class="nav-home">
                    <a href="#">
                        <i class="flaticon-user"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user.index') }}">User</a>
                </li>
            </ul>
        </div>

        {{-- Notify --}}
        <div id="flash" data-flash="{{ session('success') }}"></div>

        <div class="row">
            <div class="col-lg-12 mt-4">
                <a href="{{ route('user.create') }}" class="btn btn-secondary btn-round btn-lg">
                    <i class="fas fa-plus"></i>
                    User
                </a>
            </div>
            <div class="col-lg-12 mt-4">
                <div class="row">
                    <div class="col-md-4">
                        <form action="{{ url('/admin/user') }}">
                            <div class="form-group">
                                <div class="input-icon">
                                    <input type="text" name="search" class="form-control" placeholder="Search for..."
                                        value="{{ $search }}">
                                    <span class="input-icon-addon">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ url('/admin/user') }}">
                            <div class="form-group form-show-validation row">
                                <label for="name" class="col-lg-2 col-md-2 col-sm-3 mt-sm-2 text-right">Role</label>
                                <div class="col-lg-4 col-md-9 col-sm-8">
                                    <select class="form-control" name="role">
                                        <option value="">-- Select Role --</option>
                                        @foreach ($roles as $key => $value)
                                            <option value="{{ $key }}"
                                                {{ old('role', $role) == $key ? 'selected' : null }}>
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
                <table class="table table-hover table-head-bg-secondary">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 0; ?>
                        @foreach ($users as $user)
                            <?php $no++; ?>
                            <tr>
                                <td>{{ $no }}</td>
                                <td class="text-capitalize">{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="text-capitalize badge badge-count">{{ $user->role }}</span>
                                </td>
                                <td>
                                    <div class="form-inline">
                                        <form id="form-delete-{{ $user->id }}"
                                            action="{{ url("/admin/user/$user->id/delete") }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <a href="{{ url('admin/user/' . $user->id . '/edit') }}"
                                            class="btn btn-primary btn-link">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger btn-link"
                                            onclick="btnDelete( {{ $user->id }} )">
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
