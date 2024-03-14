
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
    <style>
        /* CSS for user list */
        .user-list {
            list-style-type: none;
            padding: 0;
        }

        .user-item {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }

        .user-item h3 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <h1>All Users</h1>
    <ul class="user-list">
        @foreach($users as $user)
            <li class="user-item">
                <h3>{{ $user->fullname }}</h3>
                <p>Email: {{ $user->email }}</p>
                <p>Phone Number: {{ $user->phone_number ?? 'N/A' }}</p>
            </li>
        @endforeach
    </ul>
</body>
</html>