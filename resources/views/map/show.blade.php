<x-app-layout
    title="Detail"
    subtitle="Sekolah">

    @section('style')

    <style>

        </style>

    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card">
                    <div class="card-body">
                        <div class="row" style="min-height: 80vh">
                            <div class="col-12 col-lg-4">
                                <h1>{{$sekolah->nama}}</h1>
                                <hr />
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Sekolah</th>
                                        <td>{{$sekolah->nama}}</td>
                                    </tr>
                                    <tr>
                                        <th>Kepala Sekolah</th>
                                        <td>{{$sekolah->kepsek}}</td>
                                    </tr>
                                </table>
                                <hr />
                                <h2>Gambar</h2>
                                <div class="row">
                                    @foreach($sekolah->getMedia('sekolah') as $media)
                                    <div class="col col-md-4 d-flex mb-3">
                                        {{$media('preview')}}
                                    </div>
                                    @endforeach
                                </div>
                                <hr/>
                                <h2>Deskripsi</h2>
                                <div class="bg-primary-lt p-4 rounded lh-lg">
                                    {{nl2br($sekolah->deskripsi)}}
                                </div>
                                <hr/>
                                <h2>Kontak</h2>
                                <div class="bg-primary-lt p-4 rounded">
                                    <div class="d-flex justify-content-between">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" /><path d="M3 7l9 6l9 -6" /></svg>
                                        {{$sekolah->kontak['\'email\''] ?? '-'}}
                                    </div>
                                    <hr/>
                                        <div class="d-flex justify-content-between">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-whatsapp"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9" /><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1" /></svg>
                                        {{$sekolah->kontak['\'hp\''] ?? '-'}}
                                    </div>
                                    <hr/>
                                    <div class="d-flex justify-content-between">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-facebook"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 10v4h3v7h4v-7h3l1 -4h-4v-2a1 1 0 0 1 1 -1h3v-4h-3a5 5 0 0 0 -5 5v2h-3" /></svg>
                                        {{$sekolah->kontak['\'fb\''] ?? '-'}}
                                    </div>
                                    <hr/>

                                    <div class="d-flex justify-content-between">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-brand-instagram"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4m0 4a4 4 0 0 1 4 -4h8a4 4 0 0 1 4 4v8a4 4 0 0 1 -4 4h-8a4 4 0 0 1 -4 -4z" /><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M16.5 7.5l0 .01" /></svg>
                                        {{$sekolah->kontak['\'ig\''] ?? '-'}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-8">
                                <x-map :addMarkerOnClik=false :showExistingMarker=true />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>
