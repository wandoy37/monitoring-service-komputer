@extends('admin.layouts.app')

@section('title', 'Edit Pengguna')

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
                <li class="separator">
                    <i class="flaticon-right-arrow"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ url("/admin/$user->id/edit") }}">Edit Pengguna</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-lg-12 mt-4">
                <a href="{{ route('user.index') }}" class="btn btn-secondary btn-round btn-border btn-lg">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="page-title">Edit Pengguna</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url("/admin/user/$user->id/update") }}" method="post">
                            @csrf
                            @method('PATCH')
                            <div class="form-group">
                                <label>Nama Lengkap</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror" placeholder="Nama Lengkap"
                                    value="{{ old('name', $user->name) }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror" placeholder="Email"
                                    value="{{ old('email', $user->email) }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="Password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control @error('role') is-invalid @enderror" name="role">
                                    <option value="">- Select Roles -</option>
                                    @foreach ($roles as $key => $value)
                                        <option value="{{ $key }}"
                                            {{ old('role', $user->role) == $key ? 'selected' : null }}>{{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group float-right">
                                <button type="submit" class="btn btn-secondary btn-round">
                                    <i class="fas fa-sync"></i>
                                    Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection
