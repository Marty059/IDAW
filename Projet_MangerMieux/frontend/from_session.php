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
                let prefixe = 'http://localhost/Projet_martin/IDAW/Projet_MangerMieux/backend'
                $.ajax({
                    url: prefixe+'user.php', // Remplacez par l'URL de votre API
                    method: 'POST',
                    data: {
                        login: login,
                        password: password
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Connexion réussie
                            $("#message").text("Connexion réussie!");

                            // Redirigez l'utilisateur vers la page de son choix, par exemple :
                            window.location.href = 'test_session.php';
                        } else {
                            // Échec de la connexion
                            $("#message").text("Identifiants invalides. Veuillez réessayer.");
                        }
                    },
                    error: function(error) {
                        $("#message").text("Erreur lors de la connexion : " + JSON.stringify(error));
                        window.location.href = 'test_session.php';
                    }
                });
            });
        });
    </script>
</body>
</html>
