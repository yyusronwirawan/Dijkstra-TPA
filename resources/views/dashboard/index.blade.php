<x-app-layout
    title
    subtitle="Dashboard">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="row mb-2">
                @foreach($cards['count'] as $card)
                <div class="col-12 col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{$card['title']}}</h4>
                            <h1
                                class="card-text fw-bolder">{{$card['count']}}</h1>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if(@$cards['chart'])
            <div class="row">
                <form method="GET" id="formSearchByWeek"
                    action="{{url()->current()}}"></form>
                <div class="col-md-6">
                    <div class="col-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-md-4 mb-2 d-flex gap-1">
                                        <input form="formSearchByWeek" type="date" name="date"
                                         value="{{request('date')}}"
                                         class="form-control" />
                                            <button class="btn btn-primary" form="formSearchByWeek">Tampilkan</button>
                                    </div>
                                    <h1>Data pengangkutan per minggu (Minggu Ke {{request('date') ? Illuminate\Support\Carbon::createFromFormat('Y-m-d',request('date'))->week : now()->week }})</h1>
                                    <canvas id="myChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
  const ctx = document.getElementById('myChart');

  new Chart(ctx, {
  type: 'bar',
data: {
      labels: @json($cards['chart'][0]),
      datasets: [{
        label: 'Jumlah Data (liter) Pengangkutan / Minggu',
        data: @json($cards['chart'][1]),
        borderWidth: 1
      }]
    },

  });
</script>
            @endif
        </div>
    </div>

</x-app-layout>
