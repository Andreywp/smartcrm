<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
@vite(['resources/css/app.css'])
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

<form method="POST" action="{{ route('login.submit') }}"
      class="bg-white p-6 border rounded w-80">
    @csrf

    <h1 class="text-lg font-semibold mb-4">Login</h1>

    <div class="mb-3">
        <label class="block text-sm mb-1">Email</label>
        <input type="email" name="email"
               class="w-full border p-2 rounded"
               required>
    </div>

    <div class="mb-4">
        <label class="block text-sm mb-1">Password</label>
        <input type="password" name="password"
               class="w-full border p-2 rounded"
               required>
    </div>

    @error('email')
    <div class="text-red-600 text-sm mb-3">
        {{ $message }}
    </div>
    @enderror

    <button
        type="submit"
        class="w-full bg-gray-800 text-white py-2 rounded"
    >
        Sign in
    </button>
</form>

</body>
</html>

