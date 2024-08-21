@php
$pengangkutan = $pengangkutan
@endphp

<x-modal title="Hapus gambar ini ?" btnSubmitText="Hapus Gambar"
    btnSubmitType="danger" btnSubmitOnClick="deleteHandler">
    <x-slot:body>
        Gambar pengangkutan yang sudah terhapus tidak bisa di dikembalikan
        secara
        semula, apakah anda yakin menghapus gambar ini ?
    </x-slot:body>
</x-modal>

<div class="mb-3">
    <label class="form-label">Merk Mobil *</label>
    @php
    $transportasi_id_ = old('transportasi_id') ?? $pengangkutan->transportasi_id
    @endphp
    <select name="transportasi_id" form="formPengangkutan" class="form-control">
        @foreach(\App\Models\Transportasi::all() as $transportasi)
        <option @selected($transportasi_id_ == $transportasi->id)
            value="{{$transportasi->id}}">{{$transportasi->merk}}
            ({{$transportasi->plat}})</option>
        @endforeach
    </select>
    @error('merk')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Pengangkut *</label>

    <input type="text" name="pengangkut" form="formPengangkutan"
        class="form-control"
        value="{{old('pengangkut',$pengangkutan->pengangkut)}}"
        placeholder="Masukan nama pengangkut" />
    @error('pengangkut')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="row d-none">
    <di class="col-12 col-md-6">
        <div class="mb-3">
            <label class="form-label">Lokasi Awal *</label>
            <input type="text" id="lokasi_awal" name="lokasi_awal" form="formPengangkutan"
                class="form-control"
                placeholder="Lokasi awal"
                value="{{old('lokasi_awal',$pengangkutan->lokasi_awal)}}" />
            @error('lokasi_awal')
            <span class="text-danger fst-italic">{{$message}}</span>
            @enderror
        </div>
    </di d-nonev>
    <div class="col-12 col-md-6">
        <div class="mb-3">
            <label class="form-label">Lokasi Tujuan *</label>
            <input type="text" id="lokasi_tujuan" name="lokasi_tujuan" form="formPengangkutan"
                class="form-control"
                placeholder="Lokasi tujuan"
                value="{{old('lokasi_tujuan',$pengangkutan->lokasi_tujuan)}}" />
            @error('lokasi_tujuan')
            <span class="text-danger fst-italic">{{$message}}</span>
            @enderror
        </div>
    </div>
</div>

<div class="mb-3 d-none">
    <label class="form-label">Jarak *</label>

    <input type="text" id="jarak" name="jarak" form="formPengangkutan" class="form-control"
        value="{{old('jarak',$pengangkutan->jarak)}}"
        placeholder="Masukan jarak" />
    @error('jarak')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Liter Diterima *</label>

    <input type="number" name="liter" form="formPengangkutan" class="form-control"
        value="{{old('liter',$pengangkutan->liter)}}"
        placeholder="Masukan jumlah liter diterima" />
    @error('liter')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Harga Tetap *</label>

    <input type="number" name="harga" form="formPengangkutan" class="form-control"
        value="{{old('harga',$pengangkutan->harga)}}"
        placeholder="Masukan harga" />
    @error('harga')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>

@if(Auth::user()->getRoleNames()[0] == 'Administrator')
<div class="mb-3">
    <label class="form-label">Status *</label>

    <input type="checkbox" name="status" form="formPengangkutan" class="form-checkbox"
        value="1" @checked(old('status',$pengangkutan->status)) />
    @error('status')
    <span class="text-danger fst-italic">{{$message}}</span>
    @enderror
</div>
@endif
<div class="mb-3">
    <label class="form-label">Gambar</label>
    <input type="file" class="form-control"
        form="formPengangkutan"
        id="images"
        name="images[]" />
    <div class="pt-3 row" id="imgOutputContainer">
    </div>
</div>
@if($pengangkutan)
<div class="row mb-3">
    @foreach($pengangkutan->getMedia('pengangkutan') as $key=> $img)
    <div class="col col-md-3">
        <div class="d-flex" style="height: 100px;">
            {{$img}}
        </div>
        <div class="mt-2">
            <form id="formDeleteImg{{$key}}" method="POST"
                action="{{route('pengangkutan.destroy.image',['pengangkutan'=>$pengangkutan->id])}}">
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
    href="{{route('pengangkutan.index')}}"
    class="btn">Kembali</a>
<button type="submit" form="formPengangkutan"
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
