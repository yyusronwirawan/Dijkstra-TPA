<x-app-layout
    title="Detail"
    subtitle="Lokasi">

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
                                <h1>{{$lokasi->nama}}</h1>
                                <hr />
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Lokasi</th>
                                        <td>{{$lokasi->nama}}</td>
                                    </tr>
                                </table>
                                <hr />
                                <h2>Gambar</h2>
                                <div class="row">
                                    @foreach($lokasi->getMedia('sekolah') as $media)
                                    <div class="col col-md-4 d-flex mb-3">
                                        {{$media('preview')}}
                                    </div>
                                    @endforeach
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
