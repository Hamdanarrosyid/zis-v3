<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<style>
    * {
        font-family: 'Times New Roman', serif;
    }
    table{
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
    }
    th,td{
        border: 1px solid black;
        border-collapse: collapse;
        text-align: center;
        padding: 8px;
    }

    .table1 {
        margin: auto;
        color: black;
    }

    h2 {
        text-align: center;
        margin-top: 10px;
        margin-bottom: 30px;
    }

</style>
<body>
<h2>
    Data Pengeluaran Barang ZIS Al-Iman
</h2>
<div class="table-responsive">
    <table class="table1">
        <thead>
        <tr>
            <th>No</th>
            <th>Keperluan</th>
            <th>Diambil Dari</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
        </tr>
        </thead>
        <tbody>
        @foreach($pengeluaran as $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->keperluan}}</td>
                <td>{{$data->bentukzis->bentuk}}</td>
                <td>{{$data->tanggal->format('d-m-Y')}}</td>
                <td>{{$data->note}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</body>
</html>
