@extends('dashboard')

@section('content')
    <div class="card bg-info bg-gradient">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Update Data User</h5>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('kelolausers.update', $kelolauser->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Nama User</label>
                            <input type="text" name="name" class="form-control"
                                value="{{ old('name', $kelolauser->name) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email User</label>
                            <input type="email" name="email" class="form-control"
                                value="{{ old('email', $kelolauser->email) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password <small>(Kosongkan jika tidak
                                    diubah)</small></label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role_id" class="form-control" required>
                                <option value="">-- Pilih Role --</option>
                                @foreach ($roles as $id => $role)
                                    <option value="{{ $id }}"
                                        {{ old('role_id', $userRole?->id) == $id ? 'selected' : '' }}>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>

                        </div>

                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
