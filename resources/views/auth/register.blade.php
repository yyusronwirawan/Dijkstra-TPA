<x-guest-layout>
        <h2 class="h3 text-center mb-3">
            Buat akun baru
          </h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @if($errors->get('name')) is-invalid @endif" name="name" placeholder="Nama lengkap" value="{{old('name')}}" autocomplete="off">
            <div class="invalid-feedback">
                @if($errors->get('name'))
                    Nama lengkap tidak boleh kosong
                @endif
            </div>
            <!-- <x-input-error :messages="$errors->get('name')" class="mt-2" /> -->
            
        </div>
        <!-- Email Address -->
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @if($errors->get('name')) is-invalid @endif" name="email" placeholder="Email" value="{{old('email')}}" autocomplete="off">
            <div class="invalid-feedback">
                @if($errors->get('email'))
                    Email tidak valid
                @endif
            </div>
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control @if($errors->get('password')) is-invalid @endif" name="password" placeholder="Password" autocomplete="off">
            <div class="invalid-feedback">
                @if($errors->get('password'))
                    Password tidak valid
                @endif
            </div>
        </div>

        <!-- Confirm Password -->
            <div class="mb-3">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" class="form-control @if($errors->get('password_confirmation')) is-invalid @endif" name="password_confirmation" placeholder="Konfirmasi Password" autocomplete="off">
            <div class="invalid-feedback">
                @if($errors->get('password_confirmation'))
                    Konfirmasi password tidak valid
                @endif
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-3">
            <button type="submit" class="btn btn-primary w-100">Buat akun</button>
        </div>
        <div class="text-center text-muted mt-3">
            Sudah terdaftar ? <a href="{{route('login')}}" tabindex="-1">Login</a>
          </div>
    </form>
</x-guest-layout>
