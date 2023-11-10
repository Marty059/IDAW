<h1>hello</h1>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet2" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>exo2</title>
    <script>
        
        PREFIX = 'http://localhost/IDAW/Projet_MangerMieux/backend';
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
            <th>type</th>
            <th>nom aliment</th>
            <th>calories</th>
            <th>Bouton</th>
            <th>showNutriments</th>
        </tr>
    </thead>

</table>
<script>
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
    $.ajax({
        type: 'POST',
        url: PREFIX + '/nutriments.php',
        data: JSON.stringify({ id: idAliment }),
        dataType: 'json',
        success: function (nutriments) {
            // Créer le contenu HTML pour la fenêtre modale
            var modalContent = '<div class="modal-body">';
            for (var nutriment in nutriments) {
                modalContent += '<p><strong>' + nutriment + ':</strong> ' + nutriments[nutriment] + '</p>';
            }
            modalContent += '</div>';

            // Créer la fenêtre modale
            var modal = $('<div class="modal" tabindex="-1" role="dialog">' +
                '<div class="modal-dialog" role="document">' +
                '<div class="modal-content">' +
                '<div class="modal-header">' +
                '<h5 class="modal-title">Nutriments</h5>' +
                '<button type="button" class="close" data-dismiss="modal" aria-label="Close">' +
                '<span aria-hidden="true">&times;</span>' +
                '</button>' +
                '</div>' +
                modalContent +
                '</div>' +
                '</div>' +
                '</div>');

            // Ajouter la fenêtre modale au corps du document
            $('body').append(modal);

            // Afficher la fenêtre modale
            modal.modal('show');

            // Supprimer la fenêtre modale du DOM après qu'elle a été fermée
            modal.on('hidden.bs.modal', function () {
                modal.remove();
            });
        },
        error: function (error) {
            console.error('Erreur lors de la récupération des nutriments', error);
        }
    });
}

</script>
</body>
</html>