<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>

    <h1>
       Table des nutriments 
    </h1>
    <table id="myTable" class="display"  style="width:100%">
    <thead>
        <tr>
            <th>nom</th>
            <th>valeur pour 100g</th>
        </tr>
    </thead>
    <tbody id="tbody">

    </tbody>

</table>
    <script>
        PREFIX = 'http://localhost/IDAW/Projet_MangerMieux/backend';
        const queryString = window.location.search;
        const params = new URLSearchParams(queryString);
        const idNutr = params.get('id_nutr');
        console.log(idNutr);

        $.ajax({
        type: 'POST',
        url: PREFIX + '/nutriments.php',
        data: JSON.stringify({ id: idNutr }),
        dataType: 'json',
        success: function (nutriments) {
            console.log("ici");
            nutriments.forEach(function (element) {
                let tab = JSON.stringify(nutriments);
                var nom = element.NOM_NUTRIMENT;
                var valeur = element.QUANTITE_POUR_100G;
                $("#tbody").append(`<tr><td>${nom}</td><td>${valeur}</td></tr>`);
            });

        },
        error: function (error) {
            console.error('Erreur lors de la récupération des nutriments', error);
        }
    });
    </script>
</div>
</body>
</html>