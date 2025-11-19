<?php


require_once('database/database.php');

session_start();


if (isset($_GET['id_user'])) {
    var_dump($_GET['id']);
    die();
    $id = $_GET['id_user'];

    // Récupération de l'utilisateur
    $sql = "SELECT * FROM users WHERE id_user = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$id]);
    $person = $query->fetch(PDO::FETCH_ASSOC);

    // Si le formulaire est soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['Nom'] ?? '';
        $prenom = $_POST['prenom'] ?? '';
        $email = $_POST['Email'] ?? '';
        $role = $_POST['Role'] ?? '';
        $password = $_POST['password'] ?? '';
        $photo = $_FILES['profil_picture']['name'] ?? '';

        // Hachage du mot de passe seulement si modifié
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_BCRYPT);
        } else {
            $password = $person['password'];
        }

        // Upload photo si présente
        if (!empty($photo)) {
            move_uploaded_file($_FILES['profil_picture']['tmp_name'], 'uploads/' . $photo);
        } else {
            $photo = $person['photo_profil'];
        }

        // Mise à jour
        $sql = "UPDATE users SET Nom=?, prenom=?, Email=?, password=?, profil_picture=?, Role=? WHERE id_user=?";
        $query = $pdo->prepare($sql);
        $query->execute([$name, $prenom, $email, $password, $photo, $role, $id]);

        header('Location: admin-dashboard-html.php');
        exit();
    }
} 




ob_start();
$pageTitle= "page d'accueile";
require_once('resources/views/admin/update-person-html.php');

$pageContent = ob_get_clean();

require_once('resources/views/layouts/admin-layout/layout_html.php');
?>

