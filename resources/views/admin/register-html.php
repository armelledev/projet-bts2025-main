


    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f9; display: flex; justify-content: center; align-items: center; height: 100vh; }
        form { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 350px; }
        h2 { text-align: center; }
        input, select { width: 100%; padding: 10px; margin: 8px 0; border: 1px solid #ddd; border-radius: 5px; }
        button { background: #4CAF50; color: white; border: none; padding: 10px; width: 100%; border-radius: 5px; cursor: pointer; }
        button:hover { background: #45a049; }
        .error { color: red; margin: 5px 0; }
        .success { color: green; text-align: center; margin-bottom: 10px; }
    </style>


    <form action="" method="POST">
        <h2>Inscription</h2>

        <?php if (!empty($errors)): ?>
            <div class="error">
                <?php foreach ($errors as $e) echo "<p>$e</p>"; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="success"><?= $success ?></div>
        <?php endif; ?>
     
    
        <label for="nom">Nom</label>
        <input type="text" name="Nom" id="Nom">

        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom">

        <label for="email">Email</label>
        <input type="email" name="Email" id="email">

        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">

        <label for="role">Role</label>
        <select name="Role" id="role">
            <option value="employe">Employé</option>
            <option value="administrateur">Administrateur</option>
        </select>
      
        <button type="submit">S'inscrire</button> 
    </form>


