<x-app-layout title="" subtitle="Map">
    @if(session('success'))
    <x-message type="success" :message="session('success')" />
    @endif
    <div id="grafMessage" class="d-none">
        <x-message message="Graf berhasil diperbarui" />
    </div>

    <input type="hidden" id="start_point" name="start_point" x-model="start"/>
    <input type="hidden" id="end_point" name="end_point" x-model="end"/>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" style="width: 100%;">
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

                    @role('User')
                    <div class="card position-absolute" style="z-index: 100000;top:150px;left:25px;">
                        <div class="card-body">
                            <div class="mb-3">
    <label class="form-label">Pilih sekolah terdekat</label>
                                <select class="form-control" id="sekolah">
                                    @foreach(\App\Models\Node::where('taggable_type','App\Models\Sekolah')->get() as $node)
                                    <option value="{{$node->id}}">{{$node->taggable->nama}}</option>
                                    @endforeach
                            </select>
                                    </div>
                            <div class="mb-3">
                                <button class="btn btn-primary btn-lg" onclick="pilihSekolahHandler()">Pilih Sekolah</button>
                                    </div>
                        </div>
                    </div>
                    @endrole
                    <x-map :shortestPath=true :showExistingMarker=true />
                </div>
            </div>
        </div>
    </div>
    <div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" data-bs-scroll="false" data-bs-backdrop="false" aria-labelledby="offcanvasBottomLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="card border-0">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <p>Mulai</p>
                                <div id="startPointCard"></div>
                            </div>
                            <div>
                                <p>Tujuan</p>
                                <div id="endPointCard"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card border-0">
                        <div class="card-body d-flex justify-content-between">
                            <div>
                                <p>Jarak</p>
                                <div id="distanceCard"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="card mb-2 border-0">
                        <div class="card-body">
                            <div>
                                <p>Rute</p>
                                <div id="pathCard"  style="height: 150px;width:100%;overflow-y: auto; padding:10px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-appuser-layout>
