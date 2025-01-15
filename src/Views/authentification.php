<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Youdemy</title>
    <link rel="stylesheet" href="assets/css/output.css">
    <link rel="stylesheet" href="assets/css/input.css">
</head>
<body class="bg-gray-900">
    <!-- Navigation -->
    <nav class="bg-gray-800/50 backdrop-blur-lg border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-teal-300">Youdemy</a>
                </div>
                
                <!-- Desktop menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/catalogue" class="text-gray-300 hover:text-blue-400 font-medium">Catalogue</a>
                    <a href="#" class="text-gray-300 hover:text-blue-400 font-medium">Enseigner</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Background Pattern -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_120%,rgba(59,130,246,0.1),rgba(59,130,246,0)_50%)]"></div>
        <div class="absolute right-0 -top-40 w-[500px] h-[500px] bg-blue-500/30 rounded-full blur-[128px]"></div>
        <div class="absolute left-0 -bottom-40 w-[500px] h-[500px] bg-teal-500/30 rounded-full blur-[128px]"></div>
    </div>

    <!-- Login/Register Section -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo and Welcome Text -->
            <div class="text-center">
                <h1 class="text-4xl font-extrabold text-white mb-2">Bienvenue sur Youdemy</h1>
                <p class="text-gray-400">Votre parcours d'apprentissage commence ici</p>
            </div>

            <div class="bg-gray-800/50 backdrop-blur-xl p-8 rounded-2xl border border-gray-700/50 shadow-xl">
                <!-- Tabs -->
                <div class="flex p-1 bg-gray-700/30 rounded-lg mb-8">
                    <button onclick="switchTab('login')" id="login-tab" class="flex-1 py-3 px-4 rounded-md text-white font-medium bg-gradient-to-r from-blue-500 to-teal-400">Connexion</button>
                    <button onclick="switchTab('register')" id="register-tab" class="flex-1 py-3 px-4 rounded-md text-gray-300 font-medium hover:bg-gray-700/50">Inscription</button>
                </div>

                <!-- Login Form -->
                <div id="login-form" class="space-y-6">
                    <form class="space-y-4">
                        <div>
                            <label for="login-email" class="text-sm font-medium text-gray-300">Adresse email</label>
                            <div class="mt-1 relative">
                                <input id="login-email" type="email" required class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="absolute left-4 top-3.5 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="login-password" class="text-sm font-medium text-gray-300">Mot de passe</label>
                            <div class="mt-1 relative">
                                <input id="login-password" type="password" required class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="absolute left-4 top-3.5 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-500 bg-gray-800 border-gray-700 rounded">
                                <span class="ml-2 text-sm text-gray-300">Se souvenir de moi</span>
                            </label>
                            <a href="#" class="text-sm text-blue-400 hover:text-blue-300">Mot de passe oublié ?</a>
                        </div>

                        <button type="submit" class="w-full py-3 px-4 rounded-lg text-white bg-gradient-to-r from-blue-500 to-teal-400 hover:from-blue-600 hover:to-teal-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-medium transition-all duration-200">
                            Se connecter
                        </button>
                    </form>
                </div>

                <!-- Register Form -->
                <div id="register-form" class="hidden space-y-6">
                    <form class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="register-firstname" class="text-sm font-medium text-gray-300">Prénom</label>
                                <input id="register-firstname" type="text" required class="mt-1 w-full px-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                            <div>
                                <label for="register-lastname" class="text-sm font-medium text-gray-300">Nom</label>
                                <input id="register-lastname" type="text" required class="mt-1 w-full px-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            </div>
                        </div>
                        
                        <div>
                            <label for="register-email" class="text-sm font-medium text-gray-300">Adresse email</label>
                            <div class="mt-1 relative">
                                <input id="register-email" type="email" required class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="absolute left-4 top-3.5 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a9 9 0 01-4.5 1.207"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label for="register-password" class="text-sm font-medium text-gray-300">Mot de passe</label>
                            <div class="mt-1 relative">
                                <input id="register-password" type="password" required class="w-full pl-12 pr-4 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <div class="absolute left-4 top-3.5 text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                </div>
                            </div>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-300">Êtes-vous un enseignant ou un étudiant ?</label>
                            <div class="mt-1 space-x-4">
                                <label class="inline-flex items-center text-gray-300">
                                    <input type="radio" name="user-type" value="teacher" class="w-4 h-4 text-blue-500 bg-gray-800 border-gray-700 rounded" required>
                                    <span class="ml-2 text-sm">Enseignant</span>
                                </label>
                                <label class="inline-flex items-center text-gray-300">
                                    <input type="radio" name="user-type" value="student" class="w-4 h-4 text-blue-500 bg-gray-800 border-gray-700 rounded" required>
                                    <span class="ml-2 text-sm">Étudiant</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" class="w-4 h-4 text-blue-500 bg-gray-800 border-gray-700 rounded">
                                <span class="ml-2 text-sm text-gray-300">Se souvenir de moi</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full py-3 px-4 rounded-lg text-white bg-gradient-to-r from-blue-500 to-teal-400 hover:from-blue-600 hover:to-teal-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-medium transition-all duration-200">
                            S'inscrire
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer class="bg-gray-800 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-gray-400">
            <p>&copy; 2025 Youdemy. Tous droits réservés.</p>
            <div class="mt-4">
                <a href="#" class="text-gray-300 hover:text-blue-400 mx-2">Politique de confidentialité</a>
                <a href="#" class="text-gray-300 hover:text-blue-400 mx-2">Conditions d'utilisation</a>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        function switchTab(tab) {
            if (tab === 'login') {
                document.getElementById('login-form').classList.remove('hidden');
                document.getElementById('register-form').classList.add('hidden');
                document.getElementById('login-tab').classList.add('bg-gradient-to-r', 'from-blue-500', 'to-teal-400');
                document.getElementById('register-tab').classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-teal-400');
                document.getElementById('register-tab').classList.add('text-gray-300', 'hover:bg-gray-700/50');
            } else if (tab === 'register') {
                document.getElementById('register-form').classList.remove('hidden');
                document.getElementById('login-form').classList.add('hidden');
                document.getElementById('register-tab').classList.add('bg-gradient-to-r', 'from-blue-500', 'to-teal-400');
                document.getElementById('login-tab').classList.remove('bg-gradient-to-r', 'from-blue-500', 'to-teal-400');
                document.getElementById('login-tab').classList.add('text-gray-300', 'hover:bg-gray-700/50');
            }
        }
    </script>
</body>
</html>