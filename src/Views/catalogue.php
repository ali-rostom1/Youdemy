<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue des cours - Youdemy</title>
    <link rel="stylesheet" href="assets/css/output.css">
    <link rel="stylesheet" href="assets/css/input.css">
</head>
<body class="bg-gray-900">
    <!-- Navigation (same as homepage) -->
    <nav class="bg-gray-800/50 backdrop-blur-lg border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20">
                <div class="flex items-center">
                    <a href="/" class="text-3xl font-extrabold bg-clip-text text-transparent bg-gradient-to-r from-blue-400 to-teal-300">Youdemy</a>
                </div>
                
                <!-- Mobile menu button -->
                <div class="flex items-center md:hidden">
                    <button type="button" onclick="toggleMenu()" class="text-gray-300 hover:text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>

                <!-- Desktop menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <div class="relative">
                        <input type="search" placeholder="Que souhaitez-vous apprendre ?" class="w-80 pl-4 pr-10 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    <a href="#" class="text-gray-300 hover:text-blue-400 font-medium">Catalogue</a>
                    <a href="#" class="text-gray-300 hover:text-blue-400 font-medium">Enseigner</a>
                    <a href="#" class="px-6 py-3 rounded-full text-white bg-gradient-to-r from-blue-500 to-teal-400 hover:from-blue-600 hover:to-teal-500">Commencer</a>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div id="mobile-menu" class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 bg-gray-800/50 backdrop-blur-lg border-b border-gray-700">
                <div class="px-4 pb-4">
                    <input type="search" placeholder="Rechercher..." class="w-full pl-4 pr-10 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <a href="#" class="block px-3 py-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700">Catalogue</a>
                <a href="#" class="block px-3 py-2 rounded-md text-gray-300 hover:text-white hover:bg-gray-700">Enseigner</a>
                <div class="px-3 pt-4">
                    <a href="#" class="block px-6 py-3 text-center rounded-full text-white bg-gradient-to-r from-blue-500 to-teal-400 hover:from-blue-600 hover:to-teal-500">Commencer</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="bg-gradient-to-r from-blue-900/50 to-teal-900/50 border-b border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-4xl font-bold text-white">Catalogue des cours</h1>
            <p class="mt-2 text-gray-400">Découvrez notre sélection de cours pour développer vos compétences</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Search and Filters Bar -->
        <div class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="flex-1">
                <div class="relative">
                    <input type="search" placeholder="Rechercher un cours..." class="w-full pl-4 pr-10 py-3 bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button class="absolute right-3 top-3 text-gray-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="flex gap-4">
                <select class="bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Tous les niveaux</option>
                    <option>Débutant</option>
                    <option>Intermédiaire</option>
                    <option>Avancé</option>
                </select>
                <select class="bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option>Type de contenu</option>
                    <option>Vidéo</option>
                    <option>Document</option>
                </select>
            </div>
        </div>

        <!-- Filters Tags -->
        <div class="flex flex-wrap gap-2 mb-8">
            <button class="px-4 py-2 rounded-full text-sm bg-blue-500/20 text-blue-300 hover:bg-blue-500/30">
                Développement Web
                <span class="ml-2">×</span>
            </button>
            <button class="px-4 py-2 rounded-full text-sm bg-blue-500/20 text-blue-300 hover:bg-blue-500/30">
                PHP
                <span class="ml-2">×</span>
            </button>
            <!-- Add more filter tags as needed -->
        </div>

        <div class="grid grid-cols-12 gap-8">
            <!-- Sidebar Filters -->
            <div class="col-span-12 md:col-span-3 space-y-6">
                <!-- Categories -->
                <div class="bg-gray-800/50 rounded-lg p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4">Catégories</h3>
                    <div class="space-y-3">
                        <?php foreach($categories as $category) :?>
                        <label class="flex items-center text-gray-300">
                            <input type="checkbox" value="<?php echo $category->id ?>" class="form-checkbox rounded text-blue-500 bg-gray-700 border-gray-600">
                            <span class="ml-2"><?php echo $category->name.'('.$category->course_count.')' ?></span>
                        </label>
                        <?php endforeach; ?>
                        <!-- Add more categories -->
                    </div>
                </div>

                <!-- Tags -->
                <div class="bg-gray-800/50 rounded-lg p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4">Tags populaires</h3>
                    <div class="flex flex-wrap gap-2">
                        <?php foreach($tags as $tag) : ?>
                        <button class="px-3 py-1 rounded-full text-sm bg-gray-700 text-gray-300 hover:bg-gray-600">
                            <?php echo $tag->name; ?>
                        </button>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Content Type Filter -->
                <div class="bg-gray-800/50 rounded-lg p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4">Type de contenu</h3>
                    <div class="space-y-3">
                        <label class="flex items-center text-gray-300">
                            <input type="checkbox" class="form-checkbox rounded text-blue-500 bg-gray-700 border-gray-600">
                            <span class="ml-2">Vidéo (<?php echo $videoCoursesCount ?>)</span>
                        </label>
                        <label class="flex items-center text-gray-300">
                            <input type="checkbox" class="form-checkbox rounded text-blue-500 bg-gray-700 border-gray-600">
                            <span class="ml-2">Document (<?php echo $documentCoursesCount ?>)</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Course Grid -->
            <div class="col-span-12 md:col-span-9">
                <!-- Sort Bar -->
                <div class="flex justify-between items-center mb-6">
                    <p class="text-gray-400">348 cours trouvés</p>
                    <select class="bg-gray-800/50 border border-gray-700 text-gray-200 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>Plus populaires</option>
                        <option>Plus récents</option>
                        <option>Prix croissant</option>
                        <option>Prix décroissant</option>
                    </select>
                </div>

                <!-- Course Cards -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Course Card -->
                     <?php foreach($courses as $course) : ?>
                    <div class="bg-gray-800 rounded-lg overflow-hidden border border-gray-700 hover:shadow-lg hover:shadow-blue-500/10 transition-shadow">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-3">
                                <?php foreach($course->tags as $index=>$tag) : ?>
                                    <?php if($index<3) : ?>
                                        <?php if($index%2 === 0) :?>
                                        <span class="px-2 py-1 rounded text-xs font-medium bg-blue-500/20 text-blue-300">
                                            <?php echo $tag->name; ?>
                                        </span>
                                        <?php else :?>
                                            <span class="px-2 py-1 rounded text-xs font-medium bg-blue-500/20 text-green-300">
                                            <?php echo $tag->name; ?>
                                        </span>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach;?>
                                <span class="px-2 py-1 rounded text-xs font-medium bg-purple-500/20 text-purple-300">
                                            <?php echo $course->type; ?>
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-white mb-2"><?php echo $course->title; ?></h3>
                            <p class="text-gray-400 text-sm mb-4"><?php echo $course->description; ?></p>
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-blue-500 flex items-center justify-center text-white text-sm font-medium">
                                        <?php 
                                            echo $course->teacher->getLogoName();
                                        ?>
                                    </div>
                                    <span class="ml-2 text-sm text-gray-400"><?php echo $course->teacher->username ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                    <!-- Repeat course cards -->
                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    <nav class="flex gap-2">
                        <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-400 hover:bg-gray-700">Précédent</button>
                        <button class="px-4 py-2 rounded-lg bg-blue-500 text-white">1</button>
                        <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-400 hover:bg-gray-700">2</button>
                        <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-400 hover:bg-gray-700">3</button>
                        <button class="px-4 py-2 rounded-lg bg-gray-800 text-gray-400 hover:bg-gray-700">Suivant</button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="bg-gray-800/30 border-t border-gray-800">
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-2 md:col-span-1">
                    <span class="text-2xl font-bold text-white">Youdemy</span>
                    <p class="mt-4 text-gray-400">La plateforme d'apprentissage qui s'adapte à vos ambitions</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">Navigation</h3>
                    <ul class="mt-4 space-y-2">
                        <li><a href="#" class="text-base text-gray-400 hover:text-white">Accueil</a></li>
                        <li><a href="#" class="text-base text-gray-400 hover:text-white">Catalogue</a></li>
                        <li><a href="#" class="text-base text-gray-400 hover:text-white">Enseigner</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <script>
        function toggleMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        }

        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) { 
                const mobileMenu = document.getElementById('mobile-menu');
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    </script>
</body>
</html>

    <?php 
        dd($courses);