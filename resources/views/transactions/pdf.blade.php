<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header img {
            max-width: 100px;
        }
        header h1 {
            margin: 5px 0;
            font-size: 24px;
        }
        header p {
            margin: 0;
            font-size: 14px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tfoot td {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        footer {
            text-align: center;
            font-size: 12px;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Laporan Transaksi Aero Hexagonal</h1>
        <p>Dibuat tanggal: {{ date('d M Y') }}</p>
    </header>

    <table>
        <thead>
            <tr>
                <th>Customer</th>
                <th>Galon Out</th>
                <th>Galon In</th>
                <th>Date</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
                <tr>
                    <td>{{ $transaction->customer_name }}</td>
                    <td>{{ $transaction->galon_out }}</td>
                    <td>{{ $transaction->galon_in }}</td>
                    <td>{{ date('d M Y', strtotime($transaction->transaction_date)) }}</td>
                    <td>Rp {{ number_format($transaction->total_price, 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="1">Total</td>
                <td>{{ $transactions->sum('galon_out') }}</td>
                <td>{{ $transactions->sum('galon_in') }}</td>
                <td></td>
                <td>Rp {{ number_format($transactions->sum('total_price'), 2, '.', ',') }}</td>
            </tr>
        </tfoot>
    </table>

    <footer>
        <p>Aero Hexagonal | Pancuran Tujuh, Jl. Cikuda-Pingku Kec. Parungpanjang Kabupaten Bogor | Contact: 085893930323</p>
    </footer>
</body>
</html>
