<x-app-layout
    title="Tambah"
    subtitle="Lokasi">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                @if($errors->any())
                <x-message type="error" message="Data gagal disimpan, mohon periksa kembali formulir anda. Pastikan data sudah
                    terisi dengan benar" />
                @endif
                <div class="card" >
                    <div class="card-body">
                        <div class="row" style="min-height: 80vh;">
                            <div class="col-12 col-lg-4">
                                <form id="formLokasi" method="POST"
                                 enctype="multipart/form-data"
                                    action="{{route('lokasi.store')}}">@csrf</form>
                                @include('lokasi._form')
                            </div>
                            <div class="col-12 col-lg-8">
                                <x-map :showExistingMarker=true/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let images = document.querySelector("#images");
        let imgOutputContainer = document.querySelector("#imgOutputContainer");
        
        images.addEventListener('change',function(e){
            imgOutputContainer.innerHTML = '';
            let files = Array.from(e.target.files);
            files.map(e => {
                let source = URL.createObjectURL(e)
                showImages(source);
            })
        })

        function showImages(source){
            let div = document.createElement('div');
            div.classList.add('col-3','rounded');
            
            let image = document.createElement('image');
            image.classList.add('d-block','rounded','p-1')
            image.style.width = '100%';
            image.style.height = '100px';
            image.style.marginBottom = '12px';
            image.style.objectFit = 'cover';
            image.style.backgroundImage = `url(${source})`;
            
            div.append(image);
            imgOutputContainer.appendChild(div)
        }
    </script>
</x-app-layout>
