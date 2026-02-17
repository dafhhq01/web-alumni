<!DOCTYPE html>
<html>
<head><title>Admin Dashboard</title></head>
<body>
    <h1>✅ Admin Dashboard</h1>
    <p>Login berhasil sebagai Admin!</p>
    <p>User: {{ auth()->user()->name }} | Role: {{ auth()->user()->role }}</p>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>