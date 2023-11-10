<h1>hello</h1>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <title>exo2</title>
    <script>
        PREFIX = 'http://localhost/Projet_martin/IDAW/Projet_MangerMieux/backend';
        $(document).ready(function(){
            console.log(PREFIX + '/aliments.php');
            $('#myTable').DataTable({
                    ajax: {
                        url: PREFIX + '/aliments.php',
                        dataSrc: ''
                    },
                    columns: [
                        { data: 'ID_ALIMENT' },
                        { data: 'ID_TYPE' },
                        { data: 'NOM_ALIMENT' },
                        { data: 'Kcal'},
                        {

                            data: null,
                                render: function (data, type, row) {
                                    return '<form class="delete-form" onsubmit="onDelete(' + row.ID_ALIMENT + '); return false;">' +
                                        '<div class="col-sm-2">' +
                                            '<input type="submit" class="btn-delete" value="Supprimer">' +
                                        '</div>' +
                                    '</form>';
                                }
                        },
                        // Nouvelle colonne pour afficher les nutriments
                        {
                            data: null,
                            render: function (data, type, row) {
                                return '<form class="nutriment-form" onsubmit="showNutriments(' + row.ID_ALIMENT + '); return false;">' +
                                        '<div class="col-sm-2">' +
                                            '<input type="submit" class="btn-nutriment" value="nutriment">' +
                                        '</div>' +
                                    '</form>';
                            }
                        },
                        {
                            data: null,
                            render: function (data, type, row) {
                                return '<form class="nutriment-form" onsubmit="ajout_historique(' + row.ID_ALIMENT + '); return false;">' +
                                        '<div class="col-sm-2">' + '<input type="text" id="add_histo">'+
                                            '<input type="submit" class="btn-nutriment" value="add">' +
                                        '</div>' +
                                    '</form>';
                            }
                        }
                    ]
            });
        });
    </script>

</head>
<body>
<div>
    <form class = "add-food" onsubmit= "ajout_food()" >
        <div class="col-sm-2">
            <input type="text" id="add_food">
            <input type="submit" class="btn-food" value="add">
        </div>
    </form>

</div>
<table id="myTable" class="display"  style="width:100%">
    <thead>
        <tr>
            <th>id</th>
            <th>type</th>
            <th>nom aliment</th>
            <th>calories</th>
            <th>Bouton</th>
            <th>showNutriments</th>
            <th>ajouter à historique</th>
        </tr>
    </thead>

</table>
<script>
    var login = '<?php echo isset($_SESSION['login']) ? $_SESSION['login'] : ''; ?>';
    var password = '<?php echo isset($_SESSION['password']) ? $_SESSION['password'] : ''; ?>';
    function onDelete(idAliment) {
        $.ajax({
            type: 'DELETE',
            url: PREFIX + '/aliment.php', 
            data: JSON.stringify({ id: idAliment }),
            contentType: 'application/json',
            success: function (response) {
                // Mettez à jour votre tableau après la suppression
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (error) {
                console.error('Erreur lors de la suppression', error);
            }
        });
    }
    function showNutriments(idAliment) {

            // Afficher les nutriments comme vous le souhaitez (par exemple, dans une boîte de dialogue)
            
            window.location.href = "http://localhost/IDAW/Projet_MangerMieux/index.php?page=show_nutriment&id_nutr="+idAliment;
}
    function ajout_historique(idPlat){
        let quantite = $('#add_histo').val();
        $.ajax({
            type: 'POST',
            url: PREFIX + '/historique.php', 
            data: JSON.stringify({ id_plat: idPlat,quantite : quantite, login : login, password: password  }),
            contentType: 'application/json',
            success: function (response) {
                // Mettez à jour votre tableau après la suppression
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (error) {
                console.error('Erreur lors de la suppression', error);}
        })
    }
    function ajout_food(){
        let code = $('#add_food').val();
        console.log("dans la fonction");
        console.log(code);
        $.ajax({
            type: 'POST',
            url: 'http://localhost/Projet_martin/IDAW/Projet_MangerMieux/backend/aliment.php', 
            data: JSON.stringify({ code:code  }),
            contentType: 'application/json',
            success: function (response) {
                console.log("c'est un succès")
                // Mettez à jour votre tableau après la suppression
                $('#myTable').DataTable().ajax.reload();
            },
            error: function (error) {
                console.log("ça va ici");
                console.error('Erreur lors de la suppression', error);}
        })
    }
</script>
</body>
</html>