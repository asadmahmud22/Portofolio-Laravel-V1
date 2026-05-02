<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-6 rounded shadow w-96">

        <h2 class="text-xl font-bold mb-4 text-center">Login Admin</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="w-full border p-2 rounded" required>
            </div>

            <button class="w-full bg-blue-500 text-white p-2 rounded">
                Login
            </button>
        </form>

        <p class="text-center mt-3">
            <a href="/register" class="text-blue-500">Daftar</a>
        </p>

    </div>
</div>

</body>
</html>