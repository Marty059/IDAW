<h1>hello</h1>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <title>exo2</title>
    <script>
        
        PREFIX = 'http://localhost/IDAW/Projet_MangerMieux/backend';
        $(document).ready(function(){
            // Récupérer les données de session PHP
            var login = "a";
            var password = "b";
            console.log(PREFIX + '/historique-bis.php');
            $('#myTable').DataTable({
                    ajax: {
                        url: PREFIX + '/historique-bis.php',
                        type: "POST",
                        contentType: 'application/json',
                        data: function(d){
                            return JSON.stringify({ login: login, password: password });
                        },
                        dataSrc: ''
                    },
                    columns: [
                        { data: 'ID_PLAT' },
                        { data: 'NOM_PLAT' },
                        { data: 'DATE'},
                        {

                            data: null,
                                render: function (data, type, row) {
                                    return '<form class="delete-form" onsubmit="onDelete(' + row.ID_PLAT + '); return false;">' +
                                        '<div class="col-sm-2">' +
                                            '<input type="submit" class="btn-delete" value="Supprimer">' +
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
<table id="myTable" class="display"  style="width:100%">
    <thead>
        <tr>
            <th>id</th>
            <th>nom plat</th>
            <th>date</th>
            <th>Supprimer</th>
        </tr>
    </thead>

</table>
<script>
    /*function onDelete(idAliment) {
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
    }*/
</script>
</body>
</html>