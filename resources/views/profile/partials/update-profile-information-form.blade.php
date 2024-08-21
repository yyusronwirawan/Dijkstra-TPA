
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">Profile Information</div>
            <div class="card-body">
                <form method="post" action="{{ route('profile.update') }}"
                    class="">
                    @csrf
                    @method('patch')
                    <div class="mb-3">
                        <label class="form-label">Nama *</label>
                        <input type="text" class="form-control"
                            name="name"
                            value="{{old('name',$user->name)}}"
                            placeholder="Masukan nama pengguna" />
                        @error('name')
                        <span class="text-danger fst-italic">Inputan tidak
                            valid</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email *</label>
                        <input type="email" class="form-control"
                            name="email"
                            value="{{old('email',$user->email)}}"
                            placeholder="Masukan email pengguna" />
                        @error('email')
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