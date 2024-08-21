@php
$sekolah = $sekolah
@endphp

<x-modal title="Hapus gambar ini ?" btnSubmitText="Hapus Gambar"
    btnSubmitType="danger" btnSubmitOnClick="deleteHandler">
    <x-slot:body>
        Gambar sekolah yang sudah terhapus tidak bisa di dikembalikan secara
        semula, apakah anda yakin menghapus gambar ini ?
    </x-slot:body>
</x-modal>

<div class="mb-3">
    <label class="form-label">Nama
        sekolah *</label>
    <input type="text" class="form-control"
        form="formSekolah"
        name="nama"
        value="{{old('nama',$sekolah->nama)}}"
        placeholder="Masukan nama sekolah" />
    @error('nama')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Alamat *</label>
    <textarea type="text" class="form-control"
        form="formSekolah"
        name="alamat"
        placeholder="Masukan alamat sekolah">{{old('alamat',$sekolah->alamat)}}</textarea>

    @error('alamat')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Nama Kepala
        Sekolah *</label>
    <input type="text" class="form-control"
        form="formSekolah"
        name="kepsek"
        value="{{old('kepsek',$sekolah->kepsek)}}"
        placeholder="Masukan nama keplaka sekolah" />
    @error('kepsek')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>
<div class="mb-3 row">
    <div class="col-12 col-md-6">
        <label class="form-label">Email</label>
        <input type="text" class="form-control"
        form="formSekolah"
        name="kontak['email']"
        value='{{old('kontak.'."'email'",@$sekolah->kontak['\'email\''] ?? '')}}'
        placeholder="Email" />
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label">Hp/WA</label>
        <input type="text" class="form-control"
        form="formSekolah"
        name="kontak['hp']"
        value='{{old('kontak.'."'hp'",@$sekolah->kontak['\'hp\''] ?? '')}}'
        placeholder="Nomor HP/WA" />
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label">Instagram</label>
        <input type="text" class="form-control"
        form="formSekolah"
        name="kontak['ig']"
        value='{{old('kontak.'."'ig'",@$sekolah->kontak['\'ig\''] ?? '')}}'
        placeholder="Akun Instagram" />
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label">Facebook</label>
        <input type="text" class="form-control"
        form="formSekolah"
        name="kontak['fb']"
        value='{{old('kontak.'."'fb'",@$sekolah->kontak['\'fb\''] ?? '')}}'
        placeholder="Akun Facebook" />
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Gambar</label>
    <input type="file" class="form-control"
        form="formSekolah"
        id="images"
        name="images[]"
        multiple />
    <div class="pt-3 row" id="imgOutputContainer">
    </div>
</div>

@if($sekolah)

@if(session('destroyImagesuccess'))
<div class>
    <x-message type="success" :message="session('destroyImagesuccess')" />
</div>
@endif
<div class="row mb-3">
    @foreach($sekolah->getMedia('sekolah') as $key=> $img)
    <div class="col col-md-3">
        <div class="d-flex" style="height: 100px;">
            {{$img}}
        </div>
        <div class="mt-2">
            <form id="formDeleteImg{{$key}}" method="POST"
                action="{{route('sekolah.destroy.image',['sekolah'=>$sekolah->id,'img'=>$key])}}">
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

<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea type="text" class="form-control"
        form="formSekolah"
        name="deskripsi"
        rows="5"
        placeholder="Masukan deskripsi sekolah">{{old('deskripsi',$sekolah->deskripsi)}}</textarea>

    @error('deskripsi')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>


<div class="mb-3">
    
    @if($sekolah)
        @php
            $coordinate = @$sekolah->node->coordinates->latitude.','.@$sekolah->node->coordinates->longitude;
        @endphp
    @endif

    <label class="form-label">Koordinat ([latitude,longitude])</label>
    <input type="text" class="form-control"
        id="markerOnClickCoordinate"
        form="formSekolah"
        name="coordinate"
        rows="5"
        value="{{old('coordinate',@$coordinate)}}"
        placeholder="Masukan titik koordinat sekolah"/>

    @error('coordinate')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<a
    href="{{route('sekolah.index')}}"
    class="btn">Kembali</a>
<button type="submit" form="formSekolah"
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