<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mini Academic System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8 border border-slate-200">
        

        <!-- Form Login -->
        <form action="#" method="POST" class="space-y-5">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Username / Email</label>
                <input type="text" placeholder="Masukkan username" required
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 text-sm">
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                <input type="password" placeholder="••••••••" required
                    class="w-full px-4 py-3 rounded-lg border border-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 text-slate-800 text-sm">
            </div>

            <div class="flex items-center justify-between text-xs">
                <label class="flex items-center text-slate-600">
                    <input type="checkbox" class="rounded border-slate-300 text-indigo-600 mr-2"> Ingat Saya
                </label>
                <a href="#" class="text-indigo-600 hover:underline">Lupa Password?</a>
            </div>

            <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg shadow-md transition duration-200">
                Masuk Sekarang
            </button>
        </form>

        <p class="text-center text-xs text-slate-500 mt-6">
            Belum punya akun? <a href="/register" class="text-indigo-600 font-semibold hover:underline">Daftar disini</a>
        </p>
    </div>

</body>
</html>