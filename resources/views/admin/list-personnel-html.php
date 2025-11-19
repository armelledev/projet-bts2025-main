<?php
// Connexion à la base
require_once 'database/database.php';

// Récupération de tous les employés
$sql = "SELECT id_user, Nom, prenom, Email, profil_picture, Role, created_at 
        FROM users 
        ORDER BY created_at DESC";
$stmt = $pdo->query($sql);
$employes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard Administrateur</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            padding: 20px;
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
    .bx.bxs-trash{
        color: red;
        font-size: 1rem;
    }
    .bx.bxs-edit{
        color: blue;
        font-size: 1rem;
    }
    </style>
</head>
<body>

<h2>Liste des Employés</h2>

<table>
    <thead>
        <tr>
            <th>Photo</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Creation date</th>
           <th>ACTION</th>

        </tr>
    </thead>
    <tbody>
        <?php if (!empty($employes)): ?>
            <?php foreach ($employes as $emp): ?>
                <tr>
                    <td>
                        <?php if ($emp['profil_picture']): ?>
                            <img src="<?= htmlspecialchars($emp['profil_picture']) ?>" alt="Photo">
                        <?php else: ?>
                            <img src="." alt="Photo">
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($emp['Nom']) ?></td>
                    <td><?= htmlspecialchars($emp['prenom']) ?></td>
                    <td><?= htmlspecialchars($emp['Email']) ?></td>
                    <td><?= htmlspecialchars($emp['Role'] ?? '—') ?></td>
                    <td><?= htmlspecialchars($emp['created_at']) ?></td>
                  <td><a href="update.php?id=<?= $emp['id_user']; ?>"> 
                  <button name="update"><i class='bx bxs-edit'></i></button></a></td>
                    <td><a href="delete.php?id=<?= $emp['id_user']; ?>"></a><button><i class='bx bxs-trash'></i>  </button></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="6">Aucun employé trouvé</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
