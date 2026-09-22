@csrf

{{-- Input Nama --}}
<div class="mb-3">
    <label class="form-label">Nama</label>
    {{-- Disesuaikan menggunakan $user->name --}}
    <input type="text" name="name"
        class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $user->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Input Email --}}
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="email" name="email"
        class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $user->email ?? '') }}">
    @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Input Password --}}
<div class="mb-3">
    <label class="form-label">Password {{ isset($user) ? '(Kosongkan jika tidak diubah)' : '' }}</label>
    <input type="password" name="password"
        class="form-control @error('password') is-invalid @enderror">
    @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Input Role --}}
<div class="mb-3">
    <label class="form-label">Role</label>
    <select name="role_id" class="form-select @error('role_id') is-invalid @enderror">
        <option value="">-- Pilih Role --</option>
        @foreach($roles as $role)
            <option value="{{ $role->id }}" @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
    @error('role_id')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror
</div>

<button type="submit" class="btn btn-success">Simpan</button>

{{-- Pastikan nama route ini sesuai dengan route di web.php kamu --}}
<a href="{{ Route::has('admin.users.index') ? route('admin.users.index') : url('/admin/users') }}" class="btn btn-secondary">
    Kembali
</a>