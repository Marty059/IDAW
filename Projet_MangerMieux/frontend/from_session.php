
    <script>
        $(document).ready(function() {
            $("#loginForm").submit(function(event) {
                event.preventDefault();
                var login = $("#login").val();
                var password = $("#password").val();
                let prefixe = 'http://localhost/IDAW/Projet_MangerMieux/backend/'
                $.ajax({
                    url: prefixe+'open_session.php', // Remplacez par l'URL de votre API
                    method: 'POST',
                    contentType: 'application/json', // Définissez le type de contenu comme JSON
                    data: JSON.stringify({ login: login, password: password }),
                    dataType: 'json',
                    success: function(response) {
                        
                        if(response==1){
                        $("#message").text("Connexion réussie!");
                        window.location.href = './index.php'
                        }
                        else{
                            $("#message").text("pas possible de ce connecter : ");
                        }
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
