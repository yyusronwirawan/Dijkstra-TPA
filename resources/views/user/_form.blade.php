@php
$user = $user
@endphp

<x-modal title="Hapus gambar ini ?" btnSubmitText="Hapus Gambar"
    btnSubmitType="danger" btnSubmitOnClick="deleteHandler">
    <x-slot:body>
        Gambar pengguna yang sudah terhapus tidak bisa di dikembalikan secara
        semula, apakah anda yakin menghapus gambar ini ?
    </x-slot:body>
</x-modal>

<div class="mb-3">
    <label class="form-label">Nama *</label>
    <input type="text" class="form-control"
        form="formPengguna"
        name="name"
        value="{{old('name',$user->name)}}"
        placeholder="Masukan nama pengguna" />
    @error('name')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Email *</label>
    <input type="email" class="form-control"
        form="formPengguna"
        name="email"
        value="{{old('email',$user->email)}}"
        placeholder="Masukan alamat email" />
    @error('email')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Password *</label>
    <input type="password" class="form-control"
        form="formPengguna"
        name="password"
        placeholder="Masukan password" />
    @error('password')
        <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Role *</label>
    <select name="role" form="formPengguna" class="form-control">
        @php
        $role_ = @$user->getRoleNames()[0] ?? old('role')
        @endphp
        @foreach($roles as $role)
        <option value="{{$role}}" @selected($role_ == $role)
             option>{{$role}}</option>
        @endforeach
    </select>
    @error('role')
        <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Gambar</label>
    <input type="file" class="form-control"
        form="formPengguna"
        id="images"
        name="images[]"/>
    <div class="pt-3 row" id="imgOutputContainer">
    </div>
</div>
@if($user)
<div class="row mb-3">
    @foreach($user->getMedia('user') as $key=> $img)
    <div class="col col-md-3">
        <div class="d-flex" style="height: 100px;">
            {{$img}}
        </div>
        <div class="mt-2">
            <form id="formDeleteImg{{$key}}" method="POST"
                action="{{route('user.destroy.image',['user'=>$user->id])}}">
                @csrf
                @method('DELETE')
            </form>
            <button
                onclick='setFormDelete("formDeleteImg{{$key}}")'
                data-bs-toggle="modal"
                data-bs-target="#modal"
                class="btn btn-danger w-full">Hapus</button>
        </div>
    </div>
    @endforeach
</div>
@endif


<a
    href="{{route('user.index')}}"
    class="btn">Kembali</a>
<button type="submit" form="formPengguna"
    class="btn btn-primary">Simpan</button>

    <script>
let formDelete = null;

function setFormDelete(form){
    formDelete = document.querySelector(`#${form}`)
}

function deleteHandler(){
    formDelete.submit();
}

</script>

