<?php
require_once './includes/vericonnect.php';

if (!isset($_GET['id'])) {
    echo "Aucune annonce spécifiée.";
    exit;
}

$id = $_GET['id'];
$stmt = $bdd->prepare("SELECT * FROM annonces WHERE id = ?");
$stmt->execute([$id]);
$annonce = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$annonce) {
    echo "Annonce introuvable.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Modifier une annonce</title>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body>
<?php include('./header.php'); ?>
<div class="p-4 sm:ml-64">
    <div class="p-6 rounded-lg mt-14 bg-gray-600 shadow-md max-w-4xl mx-auto">
        <h2 class="text-2xl font-bold text-white mb-6">Modifier l'annonce</h2>
        <form class="space-y-6" action="./includes/editannonce.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($annonce['id']); ?>">
            <div>
                <label for="titre" class="block text-sm font-medium text-white mb-1">Titre</label>
                <input type="text" id="titre" name="titre" required
                    class="w-full px-4 py-2" value="<?php echo htmlspecialchars($annonce['titre']); ?>" />
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-white mb-1">Description</label>
                <textarea id="description" name="description" rows="5" required class="w-full px-4 py-2"><?php echo htmlspecialchars($annonce['description']); ?></textarea>
            </div>
            <div>
                <label class="block text-sm font-medium text-white mb-2">Image actuelle</label>
                <img src="./includes/uploads/<?php echo htmlspecialchars($annonce['image']); ?>" alt="Image" class="w-32 h-32 object-cover rounded mb-2">
            </div>
            <div>
                <label for="dropzone-file" class="block text-sm font-medium text-white mb-2">Nouvelle image (optionnel)</label>
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-52 border-2 border-dashed border-gray-300 rounded-lg bg-gray-50 hover:bg-gray-100 cursor-pointer">
                    <div class="py-6 text-center">
                        <p class="text-sm text-gray-600">Cliquez pour changer ou glissez une image</p>
                        <p class="text-xs text-gray-500">JPG, PNG, max 2MB</p>
                    </div>
                    <input id="dropzone-file" name="image" type="file" class="hidden" accept="image/*" />
                </label>
            </div>
            <div class="text-right">
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg hover:bg-blue-700">Modifier l’annonce</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
