<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <form action="{{ route('admin.login.submit') }}" method="POST" class="bg-white p-8 rounded shadow-md w-96">
        @csrf
        <h2 class="text-2xl font-bold mb-4 text-center">Admin Login</h2>

        <input type="email" name="email" placeholder="Email" class="w-full border rounded p-2 mb-4" required>
        <input type="password" name="password" placeholder="Password" class="w-full border rounded p-2 mb-4" required>

        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Login</button>
    </form>
</body>
</html>
