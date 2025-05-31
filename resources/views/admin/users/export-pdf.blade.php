<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        h2 {
            color: #333;
            margin-bottom: 20px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2 class="text-center">Users List</h2>
    <table>
        <thead>
            <tr>
                <th>User Name</th>
                <th>Mobile Number</th>
                <th>Email</th>
                <th>Status</th>
                <th>COD Block</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $user)
                <tr>
                    <td>{{ $user['User Name'] }}</td>
                    <td>{{ $user['Mobile Number'] }}</td>
                    <td>{{ $user['Email'] }}</td>
                    <td>{{ $user['Status'] }}</td>
                    <td>{{ $user['COD Block'] }}</td>
                    <td>{{ $user['Created At'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
