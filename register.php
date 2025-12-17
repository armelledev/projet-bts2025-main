<?php
session_start();
require_once 'database/database.php';

$errors = [];

if (isset($_POST['register'])) {

    $nom     = trim($_POST['nom'] ?? '');
    $prenom  = trim($_POST['prenom'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $password= trim($_POST['password'] ?? '');
    $role    = trim($_POST['role'] ?? '');
    $profil  = $_FILES['profil'] ?? null;

    // ===== VALIDATIONS =====
    if (empty($nom)) {
        $errors['nom'] = "Le nom est obligatoire";
    }

    if (empty($prenom)) {
        $errors['prenom'] = "Le prénom est obligatoire";
    }

    if (empty($email)) {
        $errors['email'] = "L'email est obligatoire";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email invalide";
    }

    if (empty($password)) {
        $errors['password'] = "Mot de passe obligatoire";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Minimum 6 caractères";
    }

    if (!in_array($role, ['employer', 'administrateur'])) {
        $errors['role'] = "Rôle invalide";
    }

    // ===== UPLOAD IMAGE (OPTIONNEL) =====
    $filename = null;
    if ($profil && $profil['error'] === 0) {
        $allowed = ['image/jpeg','image/png','image/gif'];
        if (!in_array($profil['type'], $allowed)) {
            $errors['profil'] = "Image JPG, PNG ou GIF seulement";
        } else {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $filename = uniqid() . '_' . basename($profil['name']);
            move_uploaded_file($profil['tmp_name'], $uploadDir . $filename);
        }
    }

    // ===== INSERTION EN BASE =====
    if (empty($errors)) {

        $sql = "INSERT INTO users (nom, prenom, email, password, role, profil)
                VALUES (:nom, :prenom, :email, :password, :role, :profil)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nom'      => $nom,
            ':prenom'   => $prenom,
            ':email'    => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':role'     => $role,
            ':profil'   => $filename
        ]);

        $_SESSION['success'] = "Utilisateur enregistré avec succès";
        header("Location: list-persons.php");
        exit;
    }
}

$pageTitle = "Inscription";
ob_start();
require_once('resources/views/admin/register-html.php');
$pageContent = ob_get_clean();
require_once('resources/views/layouts/presence-layout/presence-layout_html.php');
