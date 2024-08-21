@php
$transportasi = $transportasi
@endphp

<x-modal title="Hapus gambar ini ?" btnSubmitText="Hapus Gambar"
    btnSubmitType="danger" btnSubmitOnClick="deleteHandler">
    <x-slot:body>
        Gambar pengguna yang sudah terhapus tidak bisa di dikembalikan secara
        semula, apakah anda yakin menghapus gambar ini ?
    </x-slot:body>
</x-modal>

<div class="mb-3">
    <label class="form-label">Merk Mobil *</label>
    <input type="text" class="form-control"
        form="formTransportasi"
        name="merk"
        value="{{old('merk',$transportasi->merk)}}"
        placeholder="Masukan Merk Mobil" />
    @error('merk')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Plat Nomor *</label>
    <input type="text" class="form-control"
        form="formTransportasi"
        name="plat"
        value="{{old('plat',$transportasi->plat)}}"
        placeholder="Masukan Plat Nomor" />
    @error('plat')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Pemilik *</label>
    <input type="text" class="form-control"
        form="formTransportasi"
        name="pemilik"
        value="{{old('pemilik',$transportasi->pemilik)}}"
        placeholder="Masukan Pemilik" />
    @error('pemilik')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Muatan *</label>
    <select name="muatan" form="formTransportasi" class="form-control">
        @php
        $muatan_ = @$transportasi->muatan ?? old('role')
        @endphp
        <option value="8000" @selected($muatan_ == 8000)
             option>8000 Liter</option>
        <option value="16000" @selected($muatan_ == 16000)
             option>16000 Liter</option>
    </select>
    @error('role')
        <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>


<div class="mb-3">
    <label class="form-label">Tahun *</label>
    <input type="number" class="form-control"
        form="formTransportasi"
        name="thn"
        value="{{old('thn',$transportasi->thn)}}"
        placeholder="Masukan Tahun Mobil" />
    @error('thn')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Warna *</label>
    <input type="text" class="form-control"
        form="formTransportasi"
        name="warna"
        value="{{old('warna',$transportasi->warna)}}"
        placeholder="Masukan Warna Mobil" />
    @error('warna')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Gambar</label>
    <input type="file" class="form-control"
        form="formTransportasi"
        id="images"
        name="images[]"/>
    <div class="pt-3 row" id="imgOutputContainer">
    </div>
</div>
@if($transportasi)
<div class="row mb-3">
    @foreach($transportasi->getMedia('transportasi') as $key=> $img)
    <div class="col col-md-3">
        <div class="d-flex" style="height: 100px;">
            {{$img}}
        </div>
        <div class="mt-2">
            <form id="formDeleteImg{{$key}}" method="POST"
                action="{{route('transportasi.destroy.image',['transportasi'=>$transportasi->id])}}">
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
    href="{{route('transportasi.index')}}"
    class="btn">Kembali</a>
<button type="submit" form="formTransportasi"
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

