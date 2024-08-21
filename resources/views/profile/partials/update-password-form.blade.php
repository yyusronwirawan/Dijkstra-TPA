
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">Update Password</div>
            <div class="card-body">
                <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')
                    <div class="mb-3">
                        <label class="form-label">Password saat ini *</label>
                        <input type="password" class="form-control"
                            name="current_password" />
                        @error('current_password')
                        <span class="text-danger fst-italic">Inputan tidak
                            valid</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password baru *</label>
                        <input type="password" class="form-control"
                            name="password"/>
                        @error('password')
                        <span class="text-danger fst-italic">Inputan tidak
                            valid</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password *</label>
                        <input type="password" class="form-control"
                            name="password_confirmation"/>
                        @error('password_confirmation')
                        <span class="text-danger fst-italic">Inputan tidak
                            valid</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

