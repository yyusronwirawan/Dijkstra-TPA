<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan Pengangkutan</title>
        <style>
        table {
  width: 100%;
   border-collapse: collapse;
}
        table, th, td {
  border: 1px solid;
}
    </style>
    </head>
    <body>
        <h2 style="text-align: center;margin-top: 10px;">REKAPAN PEMBAYARAN</h2>
        <h2 style="text-align: center;margin-top: 10px;">KELOMPOK JASA ANGKAT/ANGKAT MINYAK</h2>
        <h2 style="text-align: center;margin-top: 10px;">PERIODE {{$periode}} </h2>
        <table
            class>
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
                            width="24" height="24"
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
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>

    <table style="border: none;margin-top: 20px;width: 100%;">
        <tr>
            <td style="border: 0;padding-bottom: 50px;text-align: center;">Disetujui Oleh</td>
            <td style="border: 0;text-align: center;padding-bottom: 50px;">Diperiksa Oleh</td>
        </tr>
        <tr>
            <td style="border: 0;text-align: center;">(  .....  )</td>
            <td style="border: 0;text-align: center;">(  .....  )</td>
        </tr>
    </table>
</html>
<script>
    window.print()
</script>
