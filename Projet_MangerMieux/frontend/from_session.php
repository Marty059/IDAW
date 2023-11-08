<!DOCTYPE html>
<html>
<head>
    <title>Formulaire de Connexion</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Inclure jQuery -->
</head>
<body>
    <form id="loginForm">
        <label for="login">Login :</label>
        <input type="text" name="login" id="login" required>

        <br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" required>

        <br>

        <input type="submit" value="Se Connecter">
    </form>

    <div id="message"></div>

    <script>
        $(document).ready(function() {
            $("#loginForm").submit(function(event) {
                event.preventDefault();
                var login = $("#login").val();
                var password = $("#password").val();
                let prefixe = 'http://localhost/Projet_martin/IDAW/Projet_MangerMieux/backend/'
                $.ajax({
                    url: prefixe+'user.php', // Remplacez par l'URL de votre API
                    method: 'POST',
                    contentType: 'application/json', // Définissez le type de contenu comme JSON
                    data: JSON.stringify({ login: login, password: password }),
                    dataType: 'json',
                    success: function(response) {
                            $("#message").text("Connexion réussie!");
                            window.location.href = 'test_session.php'
                    },
                    error: function(error) {
                        console.log("ici");
                        $("#message").text("Erreur lors de la connexion : " + JSON.stringify(error));
                        
                    }
                });
            });
        });
    </script>
</body>
</html>
