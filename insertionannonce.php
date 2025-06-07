<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<>

    <?php
    include('header.php');
    ?>

    <body>
        <div class="p-4 sm:ml-64">
            <div class="p-6 rounded-lg mt-14 bg-gray-600 shadow-md max-w-4xl  mx-auto">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">Ajouter une annonce</h2>

                <form class="space-y-6" action="#" method="POST" enctype="multipart/form-data">

                    <div>
                        <label for="titre" class="block text-sm font-medium text-gray-700 mb-1">Titre</label>
                        <input type="text" id="titre" name="titre" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                            placeholder="Titre de l'annonce" />
                    </div>


                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="description" name="description" rows="5" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 bg-gray-50"
                            placeholder="Décris brièvement l’annonce..."></textarea>
                    </div>


                    <div>
                        <label for="dropzone-file" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        <label for="dropzone-file"
                            class="flex flex-col items-center justify-center w-full h-52 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 cursor-pointer transition duration-200">
                            <div class="flex flex-col items-center justify-center py-6">
                                <svg class="w-8 h-8 mb-3 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 16v-4m0 0V8m0 4H8m4 0h4m-6 4v1a1 1 0 001 1h1a1 1 0 001-1v-1m-3 0H9a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v7a2 2 0 01-2 2h-1" />
                                </svg>
                                <p class="mb-1 text-sm text-gray-600"><span class="font-semibold">Cliquez pour ajouter</span> ou glissez une image</p>
                                <p class="text-xs text-gray-500">JPG, PNG, GIF, max 2MB</p>
                            </div>
                            <input id="dropzone-file" name="image" type="file" class="hidden" accept="image/*" required />
                        </label>
                    </div>





                    <div class="text-right">
                        <button type="submit"
                            class="inline-block px-6 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400">
                            Ajouter l’annonce
                        </button>
                    </div>
                </form>
            </div>
        </div>


        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</html>