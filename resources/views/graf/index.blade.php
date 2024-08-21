<x-app-layout title="" subtitle="Graf">
    @if(session('success'))
    <x-message type="success" :message="session('success')" />
    @endif
    <div id="grafMessage" class="d-none">
        <x-message message="Graf berhasil diperbarui" />
    </div>

    <div class="card mb-2">
        <div class="card-body">
            <div class="row">
                <div class="col-3">
                    <h3>Mulai</h3>
                    <h4 id="mulaiText">-</h4>
                </div>
                <div class="col-3">
                    <h3>Tujuan</h3>
                    <h4 id="tujuanText">-</h4>
                </div>
                <div class="col-3">
                    <h3>Jarak (Km)</h3>
                    <h4 id="jarakText">0Km</h4>
                </div>
                <div class="col-3"><button class="btn btn-lg btn-primary" onclick="createGrafHandler()">Simpan</button></div>
            </div>
        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="row" style="min-height: 80vh">
                    <div class="col-12 col-lg-12">
                        <form
                            id="formAddNode"
                            method="POST"
                            action="{{ route('konektor.store') }}">
                            @csrf
                        </form>
                        <input
                            type="hidden"
                            name="coordinate"
                            id="markerOnClickCoordinate"
                            form="formAddNode" />

                        <form id="formAddGraf" method="POST"></form>

                        <x-map :createGraf="true" :showExistingMarker=true />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
