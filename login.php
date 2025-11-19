<?php
session_start();
require_once 'database/database.php';


$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    // Vérifier si l'utilisateur existe
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Vérifier mot de passe
        if (password_verify($mot_de_passe, $user['mot_de_passe'])) {
            // Stocker infos utilisateur en session
            $_SESSION['user'] = [
                'id' => $user['id'],
                'nom' => $user['nom'],
                'prenom' => $user['prenom'],
                'email' => $user['email'],
                'role' => $user['role']
            ];

            // Redirection selon le rôle
            if ($user['role'] === 'admin') {
                header("Location: admin-dashboard.php");
                exit();
            } else {
                header("Location: espace-prive.php?id=" . $user['id']);
                exit();
            }
        } else {
            $errors[] = "Mot de passe incorrect.";
        }
    } else {
        $errors[] = "Utilisateur non trouvé.";
    }
}



// require_once('database/database.php');


$pageTitle= "page d'accueile";
ob_start();


require_once('resources/views/users/login-html.php');

$pageContent = ob_get_clean();

require_once('resources/views/layouts/presence-layout/presence-layout_html.php');
?>


