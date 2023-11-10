

<body class="body_inscription">
<header>
    <h1 class="titre_site_inscription">Manger Mieux</h1>
</header>

<form id="inscriptionForm" action="" method="post">
    <h2 class="titre_inscription">Inscription au Tracker Alimentaire</h2>

    <label class="l_inscription" for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>

    <label class="l_inscription" for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>

    <label class="l_inscription" for="genre">Sexe :</label>
    <select id="genre" name="genre" required>
      <option value="" disabled selected>Sélectionner</option>
      <option value="masculin">Masculin</option>
      <option value="feminin">Féminin</option>
    </select>

    <label class="l_inscription" for="taille">Taille (cm) :</label>
    <input type="number" id="taille" name="taille" required>

    <label class="l_inscription" for="poids">Poids (kg) :</label>
    <input type="number" id="poids" name="poids" required>

    <label class="l_inscription" for="age">Age :</label>
    <input type="number" id="age" name="age" required>

    <label class="l_inscription" for="login">Login :</label>
    <input type="text" id="login" name="login" required>

    <label class="l_inscription" for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>

    <label class="l_inscription" for="pratique">Niveau de pratique sportive :</label>
    <select id="pratique" name="pratique" required>
      <option value="" disabled selected>Sélectionner</option>
      <option value="bas">Bas</option>
      <option value="moyen">Moyen</option>
      <option value="eleve">Élevé</option>
    </select>

    <input class="submit_inscription" type="submit" value="S'inscrire">
</body>

  <script>
    PREFIX = 'http://localhost/IDAW/Projet_MangerMieux/backend';
    $(document).ready(function() {
        $("#inscriptionForm").submit(function(event) {
            event.preventDefault(); // Empêche la soumission du formulaire par défaut

            // Récupération des données du formulaire
            var formData = {
              pratique: mapIdPratique($("#pratique").val()),
              nom: $("#nom").val(),
              prenom: $("#prenom").val(),
              genre: $("#genre").val(),
              taille: $("#taille").val(),
              poids: $("#poids").val(),
              age: $("#age").val(),
              login: $("#login").val(),
              password: $("#password").val(),
            };

            // Fonction de mappage pour id_pratique
            function mapIdPratique(value) {
                  switch (value) {
                      case "bas":
                          return 1;
                      case "moyen":
                          return 2;
                      case "eleve":
                          return 3;
                      default:
                          return null; // Gestion d'une valeur non attendue
                  }
              }

            // Envoi de la requête AJAX avec $.ajax
            $.ajax({
                type: 'POST',
                url: PREFIX + '/insert_user.php', 
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function(response) {
                    // Succès de la requête, traitez la réponse si nécessaire
                    console.log(response);
                    // Redirection vers login.php après le succès
                    window.location.href = 'login.php';
                    
                },
                error: function(error) {
                    // Gestion des erreurs
                    console.error('Erreur lors de la requête', error);
                }
            });
        });
    });
  </script>



</html>
