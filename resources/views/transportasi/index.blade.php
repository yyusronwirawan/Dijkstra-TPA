<x-app-layout
    title="Data"
    subtitle="Transportasi">

    @push('styleAndScript')
    <style>
        table img {
            width: 50px;
            height: auto;
            object-fit: cover;
            border-radius: 5px;
        }
    </style>
    @endpush

    

    @section('actions')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{route('transportasi.create')}}"
                class="btn btn-primary d-none d-sm-inline-block">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round"><path stroke="none"
                        d="M0 0h24v24H0z" fill="none" /><path
                        d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
                Tambah Data
            </a>
            <a href="{{route('transportasi.create')}}"
                class="btn btn-primary d-sm-none btn-icon"
                data-bs-toggle="modal" data-bs-target="#modal-report"
                aria-label="Tambah data baru">
                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                    height="24" viewBox="0 0 24 24" stroke-width="2"
                    stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round"><path stroke="none"
                        d="M0 0h24v24H0z" fill="none" /><path
                        d="M12 5l0 14" /><path d="M5 12l14 0" /></svg>
            </a>
        </div>
    </div>
    @endsection

    @if(session('success'))
    <x-message type="success" :message="session('success')" />
    @endif

    <x-modal title="Hapus data transportasi" btnSubmitText="Hapus" btnSubmitType="danger" btnSubmitOnClick="deleteHandler" >
        <x-slot:body>
            Data transportasi yang sudah terhapus tidak bisa di dikembalikan secara semula, apakah anda yakin menghapus data ini ?
        </x-slot:body>
    </x-modal>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card">
                    <div class="card-body border-bottom py-3">
                        <div class="d-flex">
                            <div class="text-secondary">
                                <form method="GET"
                                    action="{{url()->full()}}"
                                    id="formCount"></form>
                                Tampilkan
                                <div class="mx-2 d-inline-block">
                                    <input type="text"
                                        id="count"
                                        name="count"
                                        form="formCount"
                                        class="form-control"
                                        value="{{$count}}" size="3"
                                        aria-label="count">
                                </div>
                                entri
                            </div>
                            <div class="ms-auto text-secondary">
                                <div class="ms-2 d-flex gap-1">
                                    <form id="formSearch" method="GET"
                                        action="{{url()->full()}}"></form>
                                    <input type="hidden" name="count"
                                        value="{{$count}}" form="formSearch" />
                                    <input type="text"
                                        id="search"
                                        name="search"
                                        form="formSearch"
                                        value="{{$search}}"
                                        class="form-control"
                                        aria-label="Cari">
                                    <button type="submit" form="formPencarian"
                                        class="btn btn-primary px-4">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table
                            class="table table-sm table-striped card-table table-vcenter text-nowrap datatable">
                            <thead>
                                <tr>
                                    <th class="w-1">No</th>
                                    <th>Merk</th>
                                    <th>Plat No</th>
                                    <th>Muatan</th>
                                    <th>Pemilik</th>
                                    <th>Tahun</th>
                                    <th>Warna</th>
                                    <th>Gambar</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = $transportasis->firstItem();
                                @endphp
                                
                                @foreach($transportasis as $transportasi)
                                <tr>
                                    <td><span class="text-secondary">{{$no++}}</span></td>
                                    <td> {{ $transportasi->merk }} </td>
                                    <td> {{ $transportasi->plat }} </td>
                                    <td> {{ $transportasi->muatan }} </td>
                                    <td> {{ $transportasi->pemilik }} </td>
                                    <td> {{ $transportasi->thn }} </td>
                                    <td> {{ $transportasi->warna }} </td>
                                    <td>
                                        <div class="d-flex" style="height: 40px;width: 40px;">
                                            {{@$transportasi->getMedia('transportasi')[0]}}
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        <form id="formDelete{{$transportasi->id}}" method="POST" action="{{route('transportasi.destroy',$transportasi->id)}}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <button
                                            onclick='setFormDelete("formDelete{{$transportasi->id}}")'
                                            class="btn bg-red-lt"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal"
                                            >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24"
                                                viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon p-0 m-0"><path
                                                    stroke="none"
                                                    d="M0 0h24v24H0z"
                                                    fill="none" /><path
                                                    d="M4 7l16 0" /><path
                                                    d="M10 11l0 6" /><path
                                                    d="M14 11l0 6" /><path
                                                    d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path
                                                    d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                        </button>
                                        <a href="{{route('transportasi.edit',$transportasi->id)}}"
                                            class="btn bg-indigo-lt">
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24"
                                                viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                class="icon p-0 m-0"><path
                                                    stroke="none"
                                                    d="M0 0h24v24H0z"
                                                    fill="none" /><path
                                                    d="M4 20h4l10.5 -10.5a2.828 2.828 0 1 0 -4 -4l-10.5 10.5v4" /><path
                                                    d="M13.5 6.5l4 4" /></svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex">
                        {{ $transportasis->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let count = document.querySelector('#count');
        let formCount = document.querySelector('#formCount');
        let formDelete = null

        count.addEventListener('keyup',function(e){
            setTimeout(() => {
                if(count != ''){
                    formCount.submit()
                }   
            },1000)
        })

        function setFormDelete(form){
            formDelete = document.querySelector(`#${form}`)
        }

        function deleteHandler(){
            formDelete.submit();
        }

    </script>
</x-app-layout>
