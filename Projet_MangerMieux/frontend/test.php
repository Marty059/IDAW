<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription au Tracker Alimentaire</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    form {
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      max-width: 400px;
      width: 100%;
    }

    label {
      display: block;
      margin-bottom: 8px;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      box-sizing: border-box;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    select {
      appearance: none;
      -webkit-appearance: none;
      -moz-appearance: none;
      padding-right: 30px;
      background-image: url('dropdown-arrow.png'); /* Ajoutez une image de flèche personnalisée */
      background-position: right center;
      background-repeat: no-repeat;
    }

    input[type="submit"] {
      background-color: #4caf50;
      color: #fff;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>

  <form action="#" method="post">
    <h2>Inscription au Tracker Alimentaire</h2>

    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>

    <label for="sexe">Sexe :</label>
    <select id="sexe" name="sexe" required>
      <option value="" disabled selected>Sélectionner</option>
      <option value="masculin">Masculin</option>
      <option value="feminin">Féminin</option>
    </select>

    <label for="taille">Taille (cm) :</label>
    <input type="number" id="taille" name="taille" required>

    <label for="age">Age :</label>
    <input type="number" id="age" name="age" required>

    <label for="login">Login :</label>
    <input type="text" id="login" name="login" required>

    <label for="motDePasse">Mot de passe :</label>
    <input type="password" id="motDePasse" name="motDePasse" required>

    <label for="niveauSport">Niveau de pratique sportive :</label>
    <select id="niveauSport" name="niveauSport" required>
      <option value="" disabled selected>Sélectionner</option>
      <option value="bas">Bas</option>
      <option value="moyen">Moyen</option>
      <option value="eleve">Élevé</option>
    </select>

    <input type="submit" value="S'inscrire">
  </form>

</body>
</html>