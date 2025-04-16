<!DOCTYPE html>
<html>

<head>
    <title>Data Absen Karyawan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h3>Data Barang Masuk</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIP</th>
                <th>Waktu Masuk</th>
                <th>Waktu Keluar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row->karyawan->name }}</td>
                    <td>{{ $row->status }}</td>
                    <td>{{ $row->waktu_masuk }}</td>
                    <td>{{ $row->waktu_keluar }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
