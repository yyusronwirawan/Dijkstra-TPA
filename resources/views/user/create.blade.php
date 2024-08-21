<x-app-layout
    title="Tambah"
    subtitle="Pengguna">

    @section('style')

        <style>

        </style>

    @endsection

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden  sm:rounded-lg">
                @if($errors->any())
                <x-message type="error" message="Data gagal disimpan, mohon periksa kembali formulir anda. Pastikan data sudah
                terisi dengan benar" />
                @endif

            @if(session('success'))
    <x-message type="success" :message="session('success')" />
    @endif

                
                        <div class="row">
                            <div class="col-md-6 col-lg-5">
                                <div class="card" >
                        <div class="card-body">
                                <form id="formPengguna" method="POST"
                                 enctype="multipart/form-data"
                                    action="{{route('user.store')}}">
                                    @csrf
                                </form>
                                @include('user._form')
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
