<?php
// Connexion à la base
require_once 'database/database.php';

// Récupération de tous les employés
$sql = "SELECT id, nom, prenom, email, profil, role, created_at
        FROM users
        WHERE role = 'employer'
        ORDER BY created_at DESC";

$stmt = $pdo->query($sql);
$employes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrateur</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
        }
        h2 {
            margin-bottom: 15px;
        }
        .back-btn {
            display: inline-block;
            margin-bottom: 15px;
            padding: 8px 12px;
            background-color: #ccc;
            color: #000;
            border-radius: 6px;
            text-decoration: none;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
        }
        th, td {
            padding: 14px;
            text-align: left;
        }
        th {
            background: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .actions i {
            font-size: 1.1rem;
            cursor: pointer;
            margin-right: 8px;
        }
        .actions .edit { color: blue; }
        .actions .delete { color: red; }
    </style>
</head>
<body>

<h2>Liste des employés</h2>

<a href="index.php" class="back-btn">Retour</a>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Photo</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($employes)): ?>
            <?php foreach($employes as $emp): ?>
                <tr>
                    <td><?= htmlspecialchars($emp['id']) ?></td>
                    <td><?= htmlspecialchars($emp['nom']) ?></td>
                    <td><?= htmlspecialchars($emp['prenom']) ?></td>
                    <td><?= htmlspecialchars($emp['email']) ?></td>
                    <td><?= htmlspecialchars($emp['role']) ?></td>
                    <td>
                        <?php if(!empty($emp['profil'])): ?>
                            <img src="uploads/<?= htmlspecialchars($emp['profil']) ?>" alt="profil">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td class="actions">
                        <i class="bx bxs-edit edit"></i>
                        <i class="bx bxs-trash delete"></i>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">Aucun employé trouvé.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
