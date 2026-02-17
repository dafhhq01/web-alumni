<!DOCTYPE html>
<html>
<head><title>Alumni Profile</title></head>
<body>
    <h1>✅ Alumni Profile</h1>
    <p>Login berhasil sebagai Alumni!</p>
    <p>User: {{ auth()->user()->name }} | Role: {{ auth()->user()->role }}</p>
    <a href="{{ route('alumni.profile.complete') }}">Complete Profile</a>
    <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>