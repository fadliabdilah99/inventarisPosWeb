<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Export</title>
    <style>
        body { font-family: sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
    </style>
</head>
<body>
    <h2>Data pengajuan</h2>
    <table>
        <thead>
            <tr>
                <th>Pengaju</th>
                <th>Nama</th>
                <th>tanggal pengajuan</th>
                <th>QTY</th>
                <th>status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->nama_barang }}</td>
                    <td>{{ $item->tgl_pengajuan }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>
                        @if ($item->status == 1)
                            <span class="badge bg-success">Disetujui</span>
                        @else
                            <span>Menunggu</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
