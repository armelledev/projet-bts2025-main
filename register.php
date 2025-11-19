<?php
session_start();
require_once 'database/database.php';

$errors = [
    'nom' => '',
    'prenom' => '',
    'email' => '',
    'password' => ''
];

$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = trim($_POST['Nom'] ?? '');
    $prenom = trim($_POST['prenom'] ?? '');
    $email = trim($_POST['Email'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['Role'] ?? 'default';

    // Vérification des champs
    if (empty($nom)) {
        $errors['nom'] = "Le nom est obligatoire.";
    }

    if (empty($prenom)) {
        $errors['prenom'] = "Le prénom est obligatoire.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email invalide.";
    }

    if (strlen($password) < 6) {
        $errors['password'] = "Le mot de passe doit contenir au moins 6 caractères.";
    }

    // Vérifier si email existe déjà
    if (empty($errors['email'])) {
        $check = $pdo->prepare("SELECT id_user FROM users WHERE email=?");
        $check->execute([$email]);
        if ($check->fetch()) {
            $errors['email'] = "Cet email est déjà utilisé.";
        }
    }

    // Si pas d'erreurs
    if (!array_filter($errors)) {  // vérifie si le tableau d'erreur est vide
        $hash = password_hash($password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (Nom, prenom, Email, password, Role, created_at)
                VALUES (?, ?, ?, ?, ?, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$nom, $prenom, $email, $hash, $role]);

        $success = "Inscription réussie ! Vous pouvez vous connecter.";
    }
}

$pageTitle = "page d'accueille";

ob_start();
require_once('resources/views/admin/register-html.php');
$pageContent = ob_get_clean();

require_once('resources/views/layouts/presence-layout/presence-layout_html.php');
?>
