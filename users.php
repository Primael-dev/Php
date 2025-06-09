<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body>

    <?php
    include('header.php');
    ?>
    <?php
try{
    $bdd = new PDO('mysql:host=localhost;dbname=tasks;charset=utf8',
    'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = $bdd->query("SELECT * FROM users");

} catch (PDOException $e){
    echo "Erreur de connexion : " . $e->getMessage();
    die();
}

?>C:\xamppnew\htdocs\git php\Php\users.php
C:\xamppnew\htdocs\git php\updateannonce.php

    <div class="p-4 sm:ml-64">
        <div class="p-4   rounded-lg  mt-14">


            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Nom
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Prenom
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Date
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Action
                            </th>
                            <th scope="col" class="px-6 py-3">

                            </th>
                        </tr>
                    </thead>
                    <tbody>
                         <?php while ($row = $query->fetch(PDO::FETCH_ASSOC)) { ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                            <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?php echo $row['prenom']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row['nom']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row['date']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php echo $row['email']; ?>
                            </td>
                            <td class="px-6 py-4">
                                <a href="includes/edit.php?id=<?php echo $row['id']; ?>" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                            </td>
                            <td class="px-6 py-4">
                                <a href="includes/delete.php?id=<?php echo $row['id']; ?>" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>



        </div>
    </div>
    </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

</html>