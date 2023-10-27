<?php
    require_once("../template_header.php");
?>

<form action="" method="post">
    <h2>Inscription au Tracker Alimentaire</h2>

    <label class="l_inscription" for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label class="l_inscription" for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>

    <label class="l_inscription" for="sexe">Sexe :</label>
    <select id="sexe" name="sexe" required>
      <option value="" disabled selected>Sélectionner</option>
      <option value="masculin">Masculin</option>
      <option value="feminin">Féminin</option>
    </select>

    <label class="l_inscription" for="taille">Taille (cm) :</label>
    <input type="number" id="taille" name="taille" required>

    <label class="l_inscription" for="age">Age :</label>
    <input type="number" id="age" name="age" required>

    <label class="l_inscription" for="login">Login :</label>
    <input type="text" id="login" name="login" required>

    <label class="l_inscription" for="motDePasse">Mot de passe :</label>
    <input type="password" id="motDePasse" name="motDePasse" required>

    <label class="l_inscription" for="niveauSport">Niveau de pratique sportive :</label>
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
