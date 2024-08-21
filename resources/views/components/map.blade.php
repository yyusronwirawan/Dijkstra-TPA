@props([
'addMarkerOnClik' => true,
'pengangkutan' => false,
'showExistingMarker' => false,
'createGraf' => false,
'shortestPath' => false,
'style' => [
    'height' => '100%'
]
])

@push('styleAndScript')
<script src="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js"></script>
<link href="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css" rel="stylesheet" />
<style>
    /* Extra small devices (phones, 600px and down) */
    #map {
        width: 100% !important;
        height: {{$style['height']}} !important;
    }

    @media only screen and (max-width: 600px) {
        #map {
            width: 100% !important;
            height: {{$style['height']}} !important;
        }
    }

    /* Small devices (portrait tablets and large phones, 600px and up) */
    @media only screen and (min-width: 600px) {}

    /* Medium devices (landscape tablets, 768px and up) */
    @media only screen and (min-width: 768px) {}

    /* Large devices (laptops/desktops, 992px and up) */
    @media only screen and (min-width: 992px) {}

    /* Extra large devices (large laptops and desktops, 1200px and up) */
    @media only screen and (min-width: 1200px) {}

    .mapboxgl-popup-content{
        width: fit-content !important;

    }
     #marker {
        background-image: url('{{Vite::asset('resources/images/marker-green.png')}}');
        background-size: cover;
        width: 20px;
        height: 28px;
        cursor: pointer;
    }
</style>
@endpush
<div id="map"></div>
<script>
    // TO MAKE THE MAP APPEAR YOU MUST
    // ADD YOUR ACCESS TOKEN FROM
    // https://account.mapbox.com
    const default_coordinate = [{{ env('DEFAULT_LNG') }}, {{ env('DEFAULT_LAT') }}]
    mapboxgl.accessToken = '{{env("MAPBOX_TOKEN")}}';
    const map = new mapboxgl.Map({
        container: 'map', // container ID
        style: 'mapbox://styles/mapbox/streets-v12', // style URL
        center: default_coordinate, // starting position [lng, lat]
        zoom: 14, // starting zoom
    });

    const popup = new mapboxgl.Popup({
        offset:15,
        closeButton: true,
        closeOnClick: false
    });

    map.addControl(new mapboxgl.FullscreenControl({ container: document.querySelector('#map') }));
</script>

@if($addMarkerOnClik)
<script>
    let markerOnClick = null;
    let markerOnClickInput = document.querySelector("#markerOnClickCoordinate");

    map.on("click", (e) => {

        if (markerOnClick) {
            markerOnClick.remove();
        }

        const el = document.createElement('div');
        el.id = 'marker';

        markerOnClick = new mapboxgl.Marker(el)
                        .setLngLat(e.lngLat)
                        .addTo(map);

        markerOnClickInput.value = `${e.lngLat.lng.toString().substring(0, 12)},${e.lngLat.lat.toString().substring(0, 12)}`

        @if($createGraf)
            popup.setLngLat(e.lngLat).setHTML(
                `
                <div class="p-1">
                    <button class="btn btn-success" onclick="event.preventDefault();formAddNode.submit()">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon p-0 m-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 3h-5v5" /><path d="M16 3h5v5" /><path d="M3 3l7.536 7.536a5 5 0 0 1 1.464 3.534v6.93" /><path d="M18 6.01v-.01" /><path d="M16 8.02v-.01" /><path d="M14 10v.01" /></svg>
                    </button>
                </div>
                `
            ).addTo(map);
        @endif

    });

    
</script>
@endif

<!-- eges -->
@if($createGraf)
<script>
    let allEdges = [];
    let features = [];

    async function getAllEdges(){
        if (map.getLayer('multiple-lines-layer')) map.removeLayer('multiple-lines-layer');
        if (map.getSource('multiple-lines-source')) map.removeSource('multiple-lines-source');
        const response = await fetch('{{route("map.getAllEdges")}}')
        allEdges = await response.json()
    }

    getAllEdges()

    function showEdges(id){
        features = []
        if (map.getLayer('multiple-lines-layer')) map.removeLayer('multiple-lines-layer');
        if (map.getSource('multiple-lines-source')) map.removeSource('multiple-lines-source');

        for(d in allEdges[id]){
            features.push(allEdges[id][d])
        }

        map.addSource('multiple-lines-source', {
            'type': 'geojson',
            'data': {
                'type': 'FeatureCollection',
                'features': features
            },
        });



        map.addLayer({
            'id': 'multiple-lines-layer',
            'type': 'line',
            'source': 'multiple-lines-source',
           'layout': {
                'line-join': 'round',
                'line-cap': 'round',
            },
            'paint': {
                 'line-color': ['get','color'],
                'line-width': 4,
                'line-dasharray': [0, 1.5, 1]
            },
        });


    map.on('mouseenter','multiple-lines-layer',(e) => {
        let {id} = e.features[0].properties;
        // popup.setLngLat(coordinates).setHTML(description).addTo(map);
        popup.setLngLat(e.lngLat).setHTML(
            `<button class="btn btn-danger m-1" onclick="deleteGrafHandler(${id})">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon p-0 m-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 17l4 4" /><path d="M7 17l-4 4" /><path d="M17 3l4 4" /><path d="M21 3l-4 4" /><path d="M14 5a2 2 0 0 0 -2 2v10a2 2 0 0 1 -2 2" /></svg>    
            </button>`
        ).addTo(map);
    })
    }

</script>
@endif

@if($showExistingMarker)
<script>
    let nodes = [];
    let existingMarkers = []
    function showingExistingMarkersOnMap(data){
        map.loadImage("{{Vite::asset('resources/images/marker-blue.png')}}",(err,img) => {
            map.addImage('marker-blue',img)
        });
        map.loadImage("{{Vite::asset('resources/images/marker-red.png')}}",(err,img) => {
            map.addImage('marker-red',img)
        });

        nodes = data.map(e => {
            return {
                'id' :e.id,
                'nama' : e.nama,
                'type': 'Feature',
                'properties': {
                    'description':
                        @if($createGraf)
                        `
                        <div class="d-flex flex-column p-1">
                            <div class="mb-2">
                                <span class="h3">${e.nama}</span>
                            </div>
                            ${e.taggable_type == 'App\\Models\\Sekolah' ? 
                            (e.image ?
                            `<img class="rounded mb-2" src="${e.image.preview_url}" style="object-fit:cover;width:100%;height:100px;"/>`:'') : ''}
                            
                            <div></div>
                            <div class="d-flex flex-row align-items-start gap-1">
                                <button class="btn btn-primary" onClick='event.preventDefault();setStartAndEnd(${e.id},${e.coordinates.coordinates[1]},${e.coordinates.coordinates[0]},true)'>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-0 p-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 12l14 0" /><path d="M15 16l4 -4" /><path d="M15 8l4 4" /></svg>
                                </button>    
                                <button class="btn btn-primary" onClick='event.preventDefault();setStartAndEnd(${e.id},${e.coordinates.coordinates[1]},${e.coordinates.coordinates[0]})'>
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-0 p-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>    
                                </button>
                                
                                <button class="btn btn-success" onClick='event.preventDefault();getRoute()'>
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-0 p-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 11a1 1 0 1 1 -1 1.013a1 1 0 0 1 1 -1v-.013z" /><path d="M21 11a1 1 0 1 1 -1 1.013a1 1 0 0 1 1 -1v-.013z" /><path d="M8 12h8" /><path d="M13 9l3 3l-3 3" /></svg>
                                </button>
                                <button class="btn btn-warning" onClick='event.preventDefault();showEdges(${e.id})'>
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-0 p-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M16 4h4v4" /><path d="M15 9l5 -5" /><path d="M4 20l5 -5" /><path d="M16 20h4v-4" /><path d="M4 4l16 16" /></svg>    
                                </button>
                            ${e.taggable_type == 'App\\Models\\Konektor' ?
                                `<button class="btn btn-danger" onclick="deleteNodeHandler(${e.id})">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-0 p-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </button>`:``
                                }
                            </div>
                        <div>
                        `

                        @elseif($shortestPath)

                        `<div class="d-flex flex-column">
                            <div class="mb-2">
                                <span class="h3">${e.nama}</span>
                            </div>
                            ${e.taggable_type == 'App\\Models\\Sekolah' ? 
                            (e.image ?
                            `<img class="rounded mb-2" src="${e.image.preview_url}" style="object-fit:cover;width:100%;height:100px;"/>`:'') : ''}
                            <div class="d-flex gap-1 mt-2">
                            ${e.taggable_type == 'App\\Models\\Sekolah' ?
                            `<button class="btn btn-primary" onclick="showDetailLokasi(${e.id})">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-0 p-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 9h.01" /><path d="M11 12h1v4h1" /></svg>
                                </button>`:''}
                                <button class="btn btn-primary" onclick="setStartPoint(${e.id})">
                                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-0 p-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>    
                                </button>
                                <button class="btn btn-primary" onclick="setEndPoint(${e.id})">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-0 p-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M12.02 21.485a1.996 1.996 0 0 1 -1.433 -.585l-4.244 -4.243a8 8 0 1 1 13.403 -3.651" /><path d="M16 22l5 -5" /><path d="M21 21.5v-4.5h-4.5" /></svg>    
                                </button>
                                <button class="btn btn-primary" onclick="getShortestPathHandler()">
                                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-0 p-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10.828 9.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z" /><path d="M8 7l0 .01" /><path d="M18.828 17.828a4 4 0 1 0 -5.656 0l2.828 2.829l2.828 -2.829z" /><path d="M16 15l0 .01" /></svg>
                                </button>

                            </div>
                        </div>`

                        @else
                        `<div class="d-flex flex-column p-2">
                            <div class="mb-2">
                                <span class="h3">${e.nama}</span>
                            </div>
                            ${e.taggable_type == 'App\\Models\\Lokasi' ? 
                            (e.image ?
                            `<img class="rounded mb-2" src="${e.image.preview_url}" style="object-fit:cover;width:100%;height:100px;"/>`:'') : ''}
                        </div>`
                        @endif
                },
                'geometry': {
                    'type': 'Point',
                    'coordinates': [e.coordinates.coordinates[1],e.coordinates.coordinates[0]]
                },
                'icon': e.taggable_type == 'App\\Models\\Lokasi' ? 
                `url({{Vite::asset('resources/images/marker-blue.png')}})` 
                :
                `url({{Vite::asset('resources/images/marker-red.png')}})` 
            }
        });

    for (const m of nodes) {
        // Create a DOM element for each marker.
        const el = document.createElement('div');
        el.className = 'marker';
        el.style.backgroundImage = m.icon;
        el.style.width = `20px`;
        el.style.height = `28px`;
        el.style.backgroundSize = 'cover';
        el.addEventListener('mouseover', (e) => {
            @if(!$shortestPath)
            if (map.getLayer('multiple-lines-layer')) map.removeLayer('multiple-lines-layer');
            if (map.getSource('multiple-lines-source')) map.removeSource('multiple-lines-source');
            @endif

            map.getCanvas().style.cursor = 'pointer';
            // Copy coordinates array.
            const coordinates = m.geometry.coordinates.slice();
            const description = m.properties.description;
            // over the copy being pointed to.
            while (Math.abs(coordinates[1] - coordinates[0]) > 180) {
                coordinates[0] += coordinates[1] > coordinates[0] ? 360 : -360;
            }
            popup.setLngLat(coordinates).setHTML(description).addTo(map);
        });

        // // Add markers to the map.
        existingMarkers.push(new mapboxgl.Marker(el)
            .setLngLat(m.geometry.coordinates)
            .addTo(map));
    }
    
}

map.on('load', () => {
    fetch("{{route('map.getAllMarkers')}}")
    .then(response => response.json())
    .then(json => {
        showingExistingMarkersOnMap(json)
    })
    .catch(error => {
        // alert('Maaf data gagal ditampilkan')
    });
})
</script>
@endif

@if($createGraf)

<script>
var start;
var start_coord;
var end;
var end_coord;
let grafMessage = document.querySelector("#grafMessage")
let mulaiText = document.querySelector("#mulaiText")
let tujuanText = document.querySelector("#tujuanText")
let jarakText = document.querySelector("#jarakText")

function setStartAndEnd(id,lat,lng,isStart = false){
    if (map.getLayer('multiple-lines-layer')) map.removeLayer('multiple-lines-layer');
    if (map.getSource('multiple-lines-source')) map.removeSource('multiple-lines-source');
    let namaObj = nodes.find(x => x.id == id).nama

    if(isStart){
        mulaiText.innerText = namaObj
        if(start){
            jarakText.innerText = "0Km"
        }
        start = id;
        start_coord = [lat,lng]
    }else{
        tujuanText.innerText = namaObj
        if(start){
            jarakText.innerText = "0Km"
        }
        end = id;
        end_coord = [lat,lng]
    }
}

    // create a function to make a directions request
var polyline;
let distance = 0;
let routes = []
async function getRoute() {
    // If a layer with ID 'state-data' exists, remove it.
if (map.getLayer('route')) map.removeLayer('route');
if (map.getSource('route')) map.removeSource('route');

            if (map.getLayer('multiple-lines-layer')) map.removeLayer('multiple-lines-layer');
    if (map.getSource('multiple-lines-source')) map.removeSource('multiple-lines-source');

    if(polyline){
        polyline.remove();
    }

    if(!start){
            alert('Titik awal belum dipilih')
            return false;
        }
        if(!end){
            alert('Titik akhir belum dipilih')
            return false;
        }
  // make a directions request using cycling profile
  // an arbitrary start will always be the same
  // only the end or destination will change
  const query = await fetch(
    `https://api.mapbox.com/directions/v5/mapbox/driving/${start_coord[0]},${start_coord[1]};${end_coord[0]},${end_coord[1]}?steps=true&geometries=geojson&access_token={{ env('MAPBOX_TOKEN') }}`,
    { method: 'GET' }
  );
  const json = await query.json();
  distance = (json.routes[0].distance / 1000).toFixed(2);
  const data = json.routes[0];

  document.querySelector("#jarakText").innerText = distance + 'Km'

  data.geometry.coordinates.map(e => {
        routes.push([e[1],e[0]]);
    })


    map.addSource('route',{
        'type':'geojson',
        'data':{
            'type':'Feature',
            'properties':{},
            'geometry':{
                'type':'LineString',
                'coordinates': data.geometry.coordinates
            }
        }
    })

    map.addLayer({
        'id':'route',
        'type':'line',
        'source':'route',
        'layout': {
            'line-join': 'round',
            'line-cap': 'round',
        },
        'paint': {
            'line-color': '#004c95',
            'line-width': 4
        }
    })

    if (map.getLayer('multiple-lines-layer')) map.removeLayer('multiple-lines-layer');
    if (map.getSource('multiple-lines-source')) map.removeSource('multiple-lines-source');
    
}

async function createGrafHandler(){

     let formGraf = new FormData();
     formGraf.append('_token',"{{ csrf_token() }}");
     formGraf.append('start',start);
     formGraf.append('end',end);
     formGraf.append('jarak',distance);
     formGraf.append('rute',JSON.stringify(routes));
     routes = [];

     let response = await fetch('{{route("graf.store")}}',{
        method:'POST',
        body:formGraf
     })

     start = ''
     end = ''
     jarak = ''
     mulaiText.innerText = '';
     tujuanText.innerText = '';
     jarakText.innerText = '';

    grafMessage.classList.remove('d-none')

     getAllEdges()

    if (map.getLayer('route')) map.removeLayer('route');
    if (map.getSource('route')) map.removeSource('route');

    if (map.getLayer('multiple-lines-layer')) map.removeLayer('multiple-lines-layer');
    if (map.getSource('multiple-lines-source')) map.removeSource('multiple-lines-source');

     
}

async function deleteNodeHandler(id){
    if (map.getLayer('multiple-lines-layer')) map.removeLayer('multiple-lines-layer');
    if (map.getSource('multiple-lines-source')) map.removeSource('multiple-lines-source');
    if (map.getLayer('route')) map.removeLayer('route');
if (map.getSource('route')) map.removeSource('route');
    const formDeleteNode = new FormData();
    formDeleteNode.append('_token',"{{ csrf_token() }}");
    formDeleteNode.append('_method',"DELETE");

    let deleteRoute = '{{route("node.destroy",":id")}}';
    deleteRoute = deleteRoute.replace(':id',id);

    let response = await fetch(deleteRoute,{
        method:'POST',
        body:formDeleteNode
    })

    const currentNodes = nodes.find(e => e.id == id)
    const currentMarker = existingMarkers.find(e => e._lngLat.lng == currentNodes.geometry.coordinates[0] &&
        e._lngLat.lat == currentNodes.geometry.coordinates[1]
     )
    popup.remove()
    currentMarker.remove()
    grafMessage.classList.remove('d-none')

    getAllEdges()


}

async function deleteGrafHandler(id){
        
    let formDeleteGraf = new FormData();

    formDeleteGraf.append('_token',"{{ csrf_token() }}");
    formDeleteGraf.append('_method',"DELETE");

    let deleteGraf = '{{route("graf.destroy",":id")}}';
    deleteGraf = deleteGraf.replace(':id',id);

    let response = await fetch(deleteGraf,{
        method:'POST',
        body:formDeleteGraf
    })

    grafMessage.classList.remove('d-none')
    getAllEdges()

}
</script>

@endif

@if($shortestPath)
<script>
let startPoint;
let endPoint;

function showDetailLokasi(id){
    let url = "{{route('map.show',':id')}}"
    url = url.replace(':id',id);
    window.location = url
}

function validateSamePoint(){
    if(startPoint != undefined && endPoint != undefined){
        if(startPoint == endPoint){
            return false;
        }
        return true;
    }
    return true;
}

let currentLocation = []

if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition((coord) => {
    currentLocation = [coord.coords.latitude,coord.coords.longitude]

    // .setLngLat([coord.coords.longitude, coord.coords.latitude])
    let lat = currentLocation[0];
    let lng = currentLocation[1];
    // let lng = {{ env('DEFAULT_LNG') }}; 
    // let lat = {{ env('DEFAULT_LAT') }};
     const el = document.createElement('div');
        el.className = 'marker';
        el.style.backgroundImage = `url({{Vite::asset('resources/images/marker-kondisi.png')}})`;
        el.style.width = `20px`;
        el.style.height = `28px`;
        el.style.backgroundSize = '100%';
    const currentMarker = new mapboxgl.Marker(el)
        .setLngLat([lng, lat])
        
        .addTo(map);
        el.addEventListener('mouseover', (e) => {

            map.getCanvas().style.cursor = 'pointer';
            // Copy coordinates array.
            const coordinates = [lng,lat];
            const description = `<div class="d-flex flex-column m-1">
            <span class="mb-1 fw-bold">Lokasi saat ini</span>
            <button class="btn btn-primary" onclick="setStartPoint(-1)">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon m-0 p-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M12 12m-8 0a8 8 0 1 0 16 0a8 8 0 1 0 -16 0" /><path d="M12 2l0 2" /><path d="M12 20l0 2" /><path d="M20 12l2 0" /><path d="M2 12l2 0" /></svg>
            </button>
            </div>`;
            // over the copy being pointed to.
            while (Math.abs(coordinates[1] - coordinates[0]) > 180) {
                coordinates[0] += coordinates[1] > coordinates[0] ? 360 : -360;
            }
            popup.setLngLat(coordinates).setHTML(description).addTo(map);
        });
    });
} else {
    x.innerHTML = "Geolocation is not supported by this browser.";
}


function showOffCanvas(){
    const el = document.getElementById('offcanvasBottom')
    const offcanvas = new bootstrap.Offcanvas(el)
    offcanvas.show()
}

function showPointCard(obj,elem){
    let content = ``;
    if(typeof obj ==='object'){
        content = `
        <div class="d-flex align-items-center gap-2">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon p-0 m-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 11a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" /><path d="M17.657 16.657l-4.243 4.243a2 2 0 0 1 -2.827 0l-4.244 -4.243a8 8 0 1 1 11.314 0z" /></svg>
            <span class="fw-bold">${obj.properties.nama}</span>
        </div>
        `
    }else{
        content = `<div class="d-flex align-items-center gap-2">
            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon p-0 m-0"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M12 12m-8 0a8 8 0 1 0 16 0a8 8 0 1 0 -16 0" /><path d="M12 2l0 2" /><path d="M12 20l0 2" /><path d="M20 12l2 0" /><path d="M2 12l2 0" /></svg>
            <span class="fw-bold">Lokasi Saat ini</span>
        </div>`
    }
    elem.innerHTML = content
}

function showDistanceCard(distance){
    distanceCard.innerHTML = `<span class="fw-bold">${distance} Km</span>`
}

function showPathCard(path){
    pathCard.innerHTML = `${path}`
}

async function getNodeHandler(id){
    let url = "{{route('map.node',':id')}}"
    url = url.replace(':id',id);

    let response = await fetch(url);
    let resjson = await response.json();
    return resjson;
}

function setStartPoint(id) {
    startPoint = id
    showOffCanvas()
    if(id > 0){
        let node = getNodeHandler(id)
        node.then(e => {
            showPointCard(e,startPointCard)
        })
    }else{
        showPointCard(id,startPointCard)
    }
}
    
function setEndPoint(id) {
    endPoint = id
    showOffCanvas()
    if(id > 0){
        let node = getNodeHandler(id)
        node.then(e => {
            showPointCard(e,endPointCard)
        })
    }else{
        showPointCard(id)
    }
}

function drawingLineShortestPath(coordinates){
    if (map.getLayer('multiple-lines-layer')) map.removeLayer('multiple-lines-layer');
    if (map.getSource('multiple-lines-source')) map.removeSource('multiple-lines-source');

    map.addSource('multiple-lines-source', {
        'type': 'geojson',
        'data': {
            'type': 'FeatureCollection',
            'features': coordinates
        },
    });

    map.addLayer({
        'id': 'multiple-lines-layer',
        'type': 'line',
        'source': 'multiple-lines-source',
        'layout': {
            'line-join': 'round',
            'line-cap': 'round',
        },
        'paint': {
            'line-color': ['get','color'],
            'line-width': 4,
            'line-dasharray': [0, 1.5, 1]
        },
    });
}

async function getShortestPathHandler(){
    if(validateSamePoint()){
        showOffCanvas()
        let formShortestPath = new FormData();
        formShortestPath.append('_token',"{{ csrf_token() }}");
        formShortestPath.append('start',startPoint);
        formShortestPath.append('end',endPoint);
        formShortestPath.append('current',currentLocation);
        let res = await fetch('{{route("map.getShortestPath")}}',{
            method:'POST',
            body:formShortestPath
        })
        let {distance,perhitungan,coordinates} = await res.json()

        @if($pengangkutan)
        document.querySelector("#lokasi_awal").value = startPoint
        document.querySelector("#lokasi_tujuan").value = endPoint
        document.querySelector("#jarak").value = distance
        @endif

        showDistanceCard(distance)
        showPathCard(perhitungan)
        drawingLineShortestPath(coordinates)
    }else{
        alert('Titik mulai atau tujuan tidak valid')
    }
}

function pilihSekolahHandler(){
    setStartPoint(-1)
    setEndPoint(sekolah.value)
    getShortestPathHandler()
}

</script>
@endif