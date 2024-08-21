@php
$lokasi = $lokasi
@endphp

<x-modal title="Hapus gambar ini ?" btnSubmitText="Hapus Gambar"
    btnSubmitType="danger" btnSubmitOnClick="deleteHandler">
    <x-slot:body>
        Gambar Lokasi yang sudah terhapus tidak bisa di dikembalikan secara
        semula, apakah anda yakin menghapus gambar ini ?
    </x-slot:body>
</x-modal>

<div class="mb-3">
    <label class="form-label">Nama
        Lokasi *</label>
    <input type="text" class="form-control"
        form="formLokasi"
        name="nama"
        value="{{old('nama',$lokasi->nama)}}"
        placeholder="Masukan nama lokasi" />
    @error('nama')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>


<div class="mb-3">
    
    @if($lokasi)
        @php
            $coordinate = @$lokasi->node->coordinates->latitude.','.@$lokasi->node->coordinates->longitude;
        @endphp
    @endif

    <label class="form-label">Koordinat ([latitude,longitude])</label>
    <input type="text" class="form-control"
        id="markerOnClickCoordinate"
        form="formLokasi"
        name="coordinate"
        rows="5"
        value="{{old('coordinate',@$coordinate)}}"
        placeholder="Masukan titik koordinat lokasi"/>

    @error('coordinate')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>


<div class="mb-3">
    <label class="form-label">Gambar</label>
    <input type="file" class="form-control"
        form="formLokasi"
        id="images"
        name="images[]"
        multiple />
    <div class="pt-3 row" id="imgOutputContainer">
    </div>
</div>

@if($lokasi)

@if(session('destroyImagesuccess'))
<div class>
    <x-message type="success" :message="session('destroyImagesuccess')" />
</div>
@endif
<div class="row mb-3">
    @foreach($lokasi->getMedia('lokasi') as $key=> $img)
    <div class="col col-md-3">
        <div class="d-flex" style="height: 100px;">
            {{$img}}
        </div>
        <div class="mt-2">
            <form id="formDeleteImg{{$key}}" method="POST"
                action="{{route('lokasi.destroy.image',['lokasi'=>$lokasi->id,'img'=>$key])}}">
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
    href="{{route('lokasi.index')}}"
    class="btn">Kembali</a>
<button type="submit" form="formLokasi"
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