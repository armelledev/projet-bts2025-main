<?php
session_start();
require_once 'database/database.php';

$errors = [];

// Récupération de l'utilisateur à modifier
if (!isset($_GET['id'])) {
    header("Location: employes-list.php");
    exit;
}

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die("Utilisateur introuvable");
}

// Traitement du formulaire
if (isset($_POST['update'])) {
    $nom     = trim($_POST['nom'] ?? '');
    $prenom  = trim($_POST['prenom'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $password= trim($_POST['password'] ?? '');
    $role    = trim($_POST['role'] ?? '');
    $profil  = $_FILES['profil'] ?? null;

    // Validation simple
    if (empty($nom)) $errors['nom'] = "Le nom est obligatoire";
    if (empty($prenom)) $errors['prenom'] = "Le prénom est obligatoire";
    if (empty($email)) $errors['email'] = "L'email est obligatoire";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = "Email invalide";
    if (!in_array($role, ['employer','administrateur'])) $errors['role'] = "Rôle invalide";

    // Vérifier doublon email (autre utilisateur)
    $check = $pdo->prepare("SELECT id FROM users WHERE email = :email AND id != :id");
    $check->execute(['email'=>$email, 'id'=>$id]);
    if ($check->fetch()) $errors['email'] = "Cet email est déjà utilisé";

    // Upload image optionnelle
    $filename = $user['profil']; // conserver l'ancienne image
    if ($profil && $profil['error'] === 0) {
        $allowed = ['image/jpeg','image/png','image/gif'];
        if (!in_array($profil['type'], $allowed)) {
            $errors['profil'] = "Image JPG, PNG ou GIF seulement";
        } else {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
            $filename = uniqid() . '_' . basename($profil['name']);
            move_uploaded_file($profil['tmp_name'], $uploadDir . $filename);
        }
    }

    // Mise à jour si pas d'erreurs
    if (empty($errors)) {
        $sql = "UPDATE users SET nom=:nom, prenom=:prenom, email=:email, role=:role, profil=:profil";
        $params = [
            ':nom'=>$nom, ':prenom'=>$prenom, ':email'=>$email,
            ':role'=>$role, ':profil'=>$filename, ':id'=>$id
        ];

        // Mettre à jour le mot de passe si rempli
        if (!empty($password)) {
            $sql .= ", password=:password";
            $params[':password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $sql .= " WHERE id=:id";

        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);

        $_SESSION['success'] = "Utilisateur mis à jour avec succès";
        header("Location: employes-list.php");
        exit;
    }
}

?>