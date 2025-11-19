

<style>
    /* Conteneur du formulaire */
form {
  max-width: 500px;
  margin: 40px auto;
  padding: 25px;
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  font-family: Arial, sans-serif;
}

/* Titre */
h2 {
  text-align: center;
  color: #333;
  margin-bottom: 20px;
}

/* Chaque groupe de champ */
.form-group {
  margin-bottom: 18px;
  display: flex;
  flex-direction: column;
}

/* Labels */
label {
  font-weight: bold;
  margin-bottom: 6px;
  color: #444;
}

/* Inputs */
input[type="text"],
input[type="email"],
input[type="password"],
input[type="file"] {
  padding: 10px 12px;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 15px;
  transition: 0.3s;
}

/* Effet focus */
input:focus {
  border-color: #4A90E2;
  outline: none;
  box-shadow: 0 0 6px rgba(74,144,226,0.4);
}

/* Bouton */
button {
  width: 100%;
  padding: 12px;
  background: #4A90E2;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s;
}

button:hover {
  background: #357ABD;
}

/* Responsive */
@media (max-width: 600px) {
  form {
    padding: 15px;
  }
}

</style>
    
       <h2>Modify a worker</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="Nom" id="Nom">
        </div>
           
        <div class="form-group">
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom">
        </div>

        <div class="form-group full-width">
            <label for="email">Email :</label>
            <input type="email" name="Email" id="Email">
        </div>
        
        <div class="form-group full-width">
            <label for="password">Mot de passe :</label>
            <input type="password" name="password" id="password">
        </div>

        <div class="form-group full-width">
            <label for="photo_profil">Photo de profil (optionnelle) :</label>
            <input type="file" name="profil_picture" id="profil_picture" accept="image/*">
        </div>

        <div class="form-group full-width">
        <button type="submit" name="update">modify</button>
        </div>
    </form>