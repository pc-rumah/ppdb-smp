<div class="card bg-base-100 shadow-lg lg:col-span-2">
    <div class="card-body">
        <h2 class="card-title text-2xl mb-4">
            <i class="fas fa-exclamation-triangle text-error"></i>
            Zona Berbahaya
        </h2>

        <div class="alert alert-warning mb-4">
            <i class="fas fa-warning"></i>
            <div>
                <h3 class="font-bold">Peringatan!</h3>
                <div class="text-xs">
                    Tindakan ini tidak dapat dibatalkan. Semua data Anda akan dihapus secara permanen.
                </div>
            </div>
        </div>

        <form method="post" action="{{ route('profile.destroy') }}">
            @csrf
            @method('delete')
            {{-- Password konfirmasi --}}
            <div class="form-control mt-4 max-w-md">
                <label class="label">
                    <span class="label-text font-medium">Password</span>
                </label>
                <input type="password" name="password" class="input input-bordered w-full focus:input-error"
                    placeholder="Masukkan password anda" autocomplete="current-password" required />
                @error('password', 'userDeletion')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Tombol Aksi --}}
            <div class="card-actions justify-start pt-4">
                <button class="btn btn-error" id="deleteButton">
                    <i class="fas fa-trash"></i>
                    Hapus Akun Permanen
                </button>
            </div>
        </form>
    </div>
</div>
