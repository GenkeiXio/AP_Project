<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- External CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <title>Student Portal</title>
</head>

    <body class="min-h-screen flex flex-col items-center justify-center relative bg-gradient-to-b from-green-100 via-white to-orange-100 font-sans overflow-hidden">

        <!-- FLOATING DECORATIONS -->
        <div class="absolute top-10 left-10 text-4xl animate-bounce">🌿</div>
        <div class="absolute top-20 right-16 text-3xl animate-pulse">🦋</div>
        <div class="absolute bottom-20 left-20 text-3xl animate-bounce">🌺</div>
        <div class="absolute bottom-32 right-10 text-4xl animate-pulse">🗺️</div>

        <!-- HEADER -->
        <div class="text-center mb-10">
            <div class="flex justify-center items-center gap-3 mb-3">
                <i data-lucide="compass" class="w-10 h-10 text-green-600"></i>
                <i data-lucide="map" class="w-12 h-12 text-orange-500"></i>
                <i data-lucide="sparkles" class="w-10 h-10 text-yellow-500"></i>
            </div>

            <h1 class="text-5xl font-bold text-gray-800">
                Araling Panlipunan
            </h1>

            <p class="text-2xl text-orange-500 font-semibold">
                Grade 10 Adventure 🏝️
            </p>

            <p class="text-gray-500 mt-2">
                Tuklasin ang mundo ng kaalaman!
            </p>
        </div>

        <!-- LOGIN CARD -->
        <div class="w-full max-w-md bg-white/90 backdrop-blur-md border-2 border-gray-200 rounded-2xl shadow-xl p-8">

            <div class="text-center mb-6">
                <div class="text-6xl mb-3">🧭</div>

                <h2 class="text-2xl font-bold text-gray-800">
                    Simulan ang Paglalakbay!
                </h2>

                <p class="text-gray-500 text-sm">
                    Ilagay ang iyong pangalan para makapagsimula
                </p>
            </div>

            <form method="POST" action="{{ route('student.login') }}" class="space-y-4">
                @csrf

                <input
                    type="text"
                    name="username"
                    placeholder="Ilagay ang iyong username..."
                    class="w-full text-center text-lg h-14 border-2 border-gray-300 rounded-xl focus:outline-none focus:ring-2 focus:ring-green-400"
                    maxlength="20"
                    required
                >

                <button
                    type="submit"
                    class="w-full h-14 bg-green-500 hover:bg-green-600 text-white font-bold text-lg rounded-xl shadow-md transition"
                >
                    Magsimula! 🚀
                </button>
            </form>

        </div>

        <p class="text-gray-500 text-sm mt-6">
            Kung may existing username ka, i-type lang ito para magpatuloy ✨
        </p>

        <!-- LOCK BUTTON -->
        <button
            onclick="openLogin()"
            class="fixed bottom-6 right-6 bg-white shadow-lg w-14 h-14 rounded-full flex items-center justify-center hover:scale-110 transition"
        >
            <i data-lucide="lock"></i>
        </button>

        <!-- ADMIN / TEACHER LOGIN MODAL -->
        <div id="loginModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">

            <div class="bg-white rounded-xl w-full max-w-sm p-6 shadow-lg">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-lg">
                        Admin / Teacher Login
                    </h3>

                    <button onclick="closeLogin()">
                        <i data-lucide="x"></i>
                    </button>
                </div>

                <input
                    id="email"
                    type="email"
                    placeholder="Email"
                    class="w-full border p-3 rounded-lg mb-3"
                >

                <input
                    id="password"
                    type="password"
                    placeholder="Password"
                    class="w-full border p-3 rounded-lg mb-4"
                >

                <button
                    onclick="verifyCredentials()"
                    class="w-full bg-blue-500 hover:bg-blue-600 text-white p-3 rounded-lg"
                >
                    Continue
                </button>

            </div>
        </div>

        <!-- ACCESS CODE MODAL -->
        <div id="codeModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center">

            <div class="bg-white rounded-xl w-full max-w-sm p-6 shadow-lg">

                <div class="flex justify-between items-center mb-4">
                    <h3 class="font-bold text-lg">
                        Verify Identity
                    </h3>

                    <button onclick="closeCode()">
                        <i data-lucide="x"></i>
                    </button>
                </div>

                <p class="text-sm text-gray-500 mb-3">
                    Enter your access code to confirm identity
                </p>

                <input
                    id="access_code"
                    type="text"
                    placeholder="Access Code"
                    class="w-full border p-3 rounded-lg mb-4"
                >

                <button
                    onclick="verifyAccess()"
                    class="w-full bg-green-500 hover:bg-green-600 text-white p-3 rounded-lg"
                >
                    Login
                </button>

                <button
                    onclick="back()"
                    class="mt-3 text-sm text-gray-500 hover:underline"
                >
                    ← Back to credentials
                </button>

            </div>
        </div>

    <script>

        lucide.createIcons();

        function openLogin() {
            document.getElementById('loginModal').classList.remove('hidden');
        }

        function closeLogin() {
            document.getElementById('loginModal').classList.add('hidden');
        }

        function closeCode() {
            document.getElementById('codeModal').classList.add('hidden');
        }

        function verifyCredentials() {

            fetch('/auth/credentials', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value
                })
            })

            .then(res => res.json())
            .then(data => {

                if (data.status === "access_code_required") {

                    closeLogin();
                    document.getElementById('codeModal').classList.remove('hidden');

                } else {

                    alert(data.message);

                }

            });

        }

        function verifyAccess() {

            fetch('/auth/access-code', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    access_code: document.getElementById('access_code').value
                })
            })

            .then(res => res.json())
            .then(data => {
                window.location = data.redirect;
            });

        }

        function back() {
            closeCode();
            openLogin();
        }

    </script>
    </body>
</html>