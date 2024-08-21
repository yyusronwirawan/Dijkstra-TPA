<x-app-layout
    title="Data"
    subtitle="Pengangkutan">

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
    @if(Auth::user()->getRoleNames()->first() != 'Administrator')
    @can('create pengangkutan')
    <div class="col-auto ms-auto d-print-none">
        <div class="btn-list">
            <a href="{{route('pengangkutan.create')}}"
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
            <a href="{{route('pengangkutan.create')}}"
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
    @endcan
    @endif
    @endsection

    @if(session('success'))
    <x-message type="success" :message="session('success')" />
    @endif

    <x-modal title="Hapus data transportasi" btnSubmitText="Hapus"
        btnSubmitType="danger" btnSubmitOnClick="deleteHandler">
        <x-slot:body>
            Data pengangkutan yang sudah terhapus tidak bisa di dikembalikan
            secara semula, apakah anda yakin menghapus data ini ?
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
                                    <input type="date" class="form-control"
                                        form="formSearch"
                                        value="{{$date_start}}"
                                        name="date_start" />
                                    <input type="date" class="form-control"
                                        form="formSearch" value="{{$date_end}}"
                                        name="date_end" />
                                    <input type="text"
                                        id="search"
                                        name="search"
                                        form="formSearch"
                                        value="{{$search}}"
                                        class="form-control"
                                        aria-label="Cari">
                                    <button type="submit" form="formSearch"
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
                                    <th>Tanggal</th>
                                    <th>Nama Pengangkut</th>
                                    <th>Nomor Plat</th>
                                    <th>Lokasi Awal</th>
                                    <th>Lokasi Tujuan</th>
                                    <th>Jarak</th>
                                    <th>Liter Diterima</th>
                                    <th>Bukti</th>
                                    @if(Auth::user()->getRoleNames()[0] !=
                                    'Administrator')
                                    @can('show pengangkutan-harga')
                                    <th>Harga tetap</th>
                                    <th>Pendapatan Liter Diterima x Harga</th>
                                    @endcan
                                    @endif
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = $pengangkutans->firstItem();
                                @endphp

                                @foreach($pengangkutans as $pengangkutan)
                                <tr>
                                    <td><span
                                            class="text-secondary">{{$no++}}</span></td>
                                    <td> {{
                                        $pengangkutan->created_at->format('m/d/Y')
                                        }} </td>
                                    <td> {{ $pengangkutan->pengangkut }} </td>
                                    <td> {{$pengangkutan->transportasi->plat}}
                                    </td>
                                    <td> {{
                                        $pengangkutan->nodeAwal->taggable->nama
                                        ?? 'Node '.$pengangkutan->nodeAwal->id
                                        }}</td>
                                    <td> {{
                                        $pengangkutan->nodeTujuan->taggable->nama
                                        ?? 'Node '.$pengangkutan->nodeTujuan->id
                                        }}</td>
                                    <td> {{ $pengangkutan->jarak }} KM </td>
                                    <td> {{ $pengangkutan->liter }} Liter </td>
                                    <td>
                                        <div class="d-flex"
                                            style="height: 40px;width: 40px;">
                                            {{@$pengangkutan->getMedia('pengangkutan')[0]}}
                                        </div>
                                    </td>
                                    @if(Auth::user()->getRoleNames()[0] !=
                                    'Administrator')
                                    @can('show pengangkutan-harga')
                                    <td>Rp {{$pengangkutan->harga}}</td>
                                    <td>Rp {{number_format($pengangkutan->harga
                                        * $pengangkutan->liter,2)}}</td>
                                    @endcan
                                    @endif
                                    <td>
                                        @if($pengangkutan->status == '1')
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-check"
                                            width="44" height="44"
                                            viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="#2c3e50"
                                            fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none"
                                                d="M0 0h24v24H0z" fill="none" />
                                            <path d="M5 12l5 5l10 -10" />
                                        </svg>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        <form
                                            id="formDelete{{$pengangkutan->id}}"
                                            method="POST"
                                            action="{{route('pengangkutan.destroy',$pengangkutan->id)}}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <button
                                            onclick='setFormDelete("formDelete{{$pengangkutan->id}}")'
                                            class="btn bg-red-lt"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modal">
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
                                        <a
                                            href="{{route('pengangkutan.edit',$pengangkutan->id)}}"
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
                                    <td></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex">
                        <a href="{{route('pengangkutan.report').'?'.request()->getQueryString()}}">Cetak</a>
                        {{ $pengangkutans->links() }}
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
