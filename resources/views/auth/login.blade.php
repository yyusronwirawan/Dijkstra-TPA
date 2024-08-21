<x-guest-layout>
    <h2 class="h3 text-center mb-3">
            Login to akun anda
          </h2>
          
            <form method="POST" action="{{ route('login') }}">
        @csrf
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control @if($errors->get('email')) is-invalid @endif" name="email" placeholder="example@email.com" value="{{old('email')}}" autocomplete="off">
              <div class="invalid-feedback">
                @if($errors->get('email'))
                    @if($errors->get('email')[0] == 'auth.failed')
                      Maaf login gagal, mohon periksa kembali akun anda
                    @else
                      Email harus valid
                    @endif
                @endif
            </div>
            </div>
            <div class="mb-2" x-data="{showPassword:false}">
              <label class="form-label d-flex justify-content-between">
                Password
                  <a href="#" class="link-secondary1" @click="showPassword = !showPassword" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                  </a>
                @if (Route::has('password.request'))
                <span class="form-label-description">
                  <a href="./forgot-password.html">I forgot password</a>
                </span>
                @endif
              </label>
            
                <input x-bind:type="showPassword ? 'text':'password'" class="form-control @if($errors->get('password')) is-invalid @endif"  placeholder="Your password" 
                name="password"
                autocomplete="off">
                <div class="invalid-feedback">
            @if($errors->get('password'))
                Password harus valid
            @endif
        </div>
              
            </div>
            <div class="mb-2">
              <label class="form-check">
                <input type="checkbox" class="form-check-input" name="remember"/>
                <span class="form-check-label">Ingatkan saya di perangkat ini</span>
              </label>
            </div>
            <div class="form-footer">
              <button type="submit" class="btn btn-primary w-100">Masuk</button>
            </div>
          </form>
          <!-- <div class="text-center text-muted mt-3">
            Belum punya akun ? <a href="{{route('register')}}" tabindex="-1">Daftar</a>
          </div> -->
</x-guest-layout>
