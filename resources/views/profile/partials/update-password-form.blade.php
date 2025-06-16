<div class="card bg-base-100 shadow-lg">
    <div class="card-body">
        <h2 class="card-title text-2xl mb-4">
            <i class="fas fa-lock text-warning"></i>
            Ubah Password
        </h2>

        <form method="post" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            @method('put')

            {{-- Password Saat Ini --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Password Sekarang</span>
                </label>
                <div class="relative">
                    <input type="password" name="current_password" id="currentPassword"
                        placeholder="Masukkan password sekarang"
                        class="input input-bordered w-full focus:input-warning pr-12" autocomplete="current-password" />
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        onclick="togglePassword('currentPassword')">
                        <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                    </button>
                </div>
                @error('current_password', 'updatePassword')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Password Baru --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Password Baru</span>
                </label>
                <div class="relative">
                    <input type="password" name="password" id="newPassword" placeholder="Masukkan password baru"
                        class="input input-bordered w-full focus:input-warning pr-12" autocomplete="new-password" />
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        onclick="togglePassword('newPassword')">
                        <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                    </button>
                </div>
                @error('password', 'updatePassword')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Konfirmasi Password Baru --}}
            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Konfirmasi Password Baru</span>
                </label>
                <div class="relative">
                    <input type="password" name="password_confirmation" id="confirmPassword"
                        placeholder="Konfirmasi password baru"
                        class="input input-bordered w-full focus:input-warning pr-12" autocomplete="new-password" />
                    <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                        onclick="togglePassword('confirmPassword')">
                        <i class="fas fa-eye text-gray-400 hover:text-gray-600"></i>
                    </button>
                </div>
                @error('password_confirmation', 'updatePassword')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            {{-- Aksi --}}
            <div class="card-actions justify-end pt-4">
                <button class="btn btn-warning" type="submit">
                    <i class="fas fa-key"></i>
                    Update Password
                </button>
            </div>

            {{-- Status berhasil --}}
            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600">
                    Password berhasil diperbarui.
                </p>
            @endif
        </form>
    </div>
</div>

{{-- Script Toggle Password --}}
<script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
