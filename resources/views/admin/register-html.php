<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Modifier utilisateur</title>
    <style>
        /* Copier ton CSS du formulaire existant */
        body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;background:#f7f3f9;display:flex;justify-content:center;align-items:center;height:100vh;margin:0;}
        form{background:#fff;padding:20px 25px;border-radius:10px;box-shadow:0 4px 10px rgba(0,0,0,.1);width:320px;}
        label{display:block;margin-bottom:5px;font-size:14px;color:#555;}
        input,select{width:100%;padding:8px 10px;margin-bottom:10px;border-radius:6px;border:1px solid #ccc;}
        button{width:100%;padding:10px;background:#a3bffa;color:#fff;border:none;border-radius:6px;cursor:pointer;}
        button:hover{background:#839df0;}
        .error-message{color:#e07a7a;font-size:12px;margin-bottom:6px;}
        .back-btn{display:inline-block;margin-top:10px;padding:8px 12px;background:#ccc;color:#000;border-radius:6px;text-decoration:none;}
        img{width:50px;height:50px;border-radius:50%;object-fit:cover;margin-bottom:10px;}
    </style>
</head>
<body>

<form action="" method="POST" enctype="multipart/form-data">
    <label>Nom</label>
    <?php if(isset($errors['nom'])): ?><p class="error-message"><?= $errors['nom'] ?></p><?php endif; ?>
    <input type="text" name="nom" value="<?= htmlspecialchars($_POST['nom'] ?? $user['nom']) ?>">

    <label>Prénom</label>
    <?php if(isset($errors['prenom'])): ?><p class="error-message"><?= $errors['prenom'] ?></p><?php endif; ?>
    <input type="text" name="prenom" value="<?= htmlspecialchars($_POST['prenom'] ?? $user['prenom']) ?>">

    <label>Email</label>
    <?php if(isset($errors['email'])): ?><p class="error-message"><?= $errors['email'] ?></p><?php endif; ?>
    <input type="email" name="email" value="<?= htmlspecialchars($_POST['email'] ?? $user['email']) ?>">

    <label>Mot de passe (laisser vide pour conserver)</label>
    <?php if(isset($errors['password'])): ?><p class="error-message"><?= $errors['password'] ?></p><?php endif; ?>
    <input type="password" name="password">

    <label>Rôle</label>
    <select name="role">
        <option value="employer" <?= (($user['role'] ?? '')=='employer')?'selected':'' ?>>Employer</option>
        <option value="administrateur" <?= (($user['role'] ?? '')=='administrateur')?'selected':'' ?>>Administrateur</option>
    </select>

    <label>Photo de profil (optionnelle)</label>
    <?php if($user['profil']): ?>
        <img src="uploads/<?= htmlspecialchars($user['profil']) ?>" alt="profil">
    <?php endif; ?>
    <?php if(isset($errors['profil'])): ?><p class="error-message"><?= $errors['profil'] ?></p><?php endif; ?>
    <input type="file" name="profil" accept="image/*">

    <button type="submit" name="update">Mettre à jour</button>
</form>

<a href="employes-list.php" class="back-btn">Retour à la liste</a>
</body>
</html>