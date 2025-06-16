<div class="card bg-base-100 shadow-lg">
    <div class="card-body">
        <h2 class="card-title text-2xl mb-4">
            <i class="fas fa-user text-primary"></i>
            Informasi Profile
        </h2>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

        <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('patch')

            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Nama Lengkap</span>
                </label>
                <input type="text" name="name" id="name" placeholder="Masukkan nama lengkap"
                    class="input input-bordered w-full focus:input-primary" value="{{ old('name', $user->name) }}"
                    required autofocus autocomplete="name" />
                @error('name')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-control">
                <label class="label">
                    <span class="label-text font-medium">Email</span>
                </label>
                <input type="email" name="email" id="email" placeholder="Masukkan email"
                    class="input input-bordered w-full focus:input-primary" value="{{ old('email', $user->email) }}"
                    required autocomplete="username" />
                @error('email')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div class="mt-2 text-sm text-gray-800">
                        Alamat email Anda belum diverifikasi.
                        <button form="send-verification"
                            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary">
                            Klik di sini untuk mengirim ulang email verifikasi.
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600">
                                Tautan verifikasi baru telah dikirim ke email Anda.
                            </p>
                        @endif
                    </div>
                @endif
            </div>

            <div class="card-actions justify-end pt-4">
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-save"></i>
                    Simpan Perubahan
                </button>
            </div>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-green-600">
                    Perubahan berhasil disimpan.
                </p>
            @endif
        </form>
    </div>
</div>
