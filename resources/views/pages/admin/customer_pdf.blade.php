<!DOCTYPE html>
<html>
<head>
    <title>Customer Report</title>
    <style>
        /* Atur border untuk tabel */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Customer Report</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Total Transaction</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->telp }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->total_transaction }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
