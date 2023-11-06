<h1>hello</h1>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" />
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <title>exo2</title>
    <script>
        
        PREFIX = 'http://localhost/IDAW/Projet_MangerMieux/backend';
        $(document).ready(function(){
            console.log(PREFIX + '/aliment.php');
            $('#myTable').DataTable({
                    ajax: {
                        url: PREFIX + '/aliment.php',
                        dataSrc: ''
                    },
                    columns: [
                        { data: 'ID_ALIMENT' },
                        { data: 'ID_TYPE' },
                        { data: 'NOM_ALIMENT' },
                        { data: 'Kcal'},
                        {
                            /*data:"modifier",
                            defaultContent: '<input type="delete id="Supprimer" value="Supprimer">',
                            target: -1,*/
                            data: null,
                                render: function(data, type, row) {
                            return '<button class="deleteButton" data-id="' + row.ID_ALIMENT + '">Supprimer</button>';
                        }
                        }
                    ]
            });

             // Click event for delete button
             $('#myTable').on('click', '.deleteButton', function() {
                const alimentId = $(this).data('id');
                deleteAliment(alimentId);
            });
        });

        // Function to perform DELETE operation
        function deleteAliment(alimentId) {
            $.ajax({
                url: PREFIX + '/aliment.php?id=' + alimentId,
                type: 'DELETE',
                success: function(response) {
                    // Handle success, e.g., refresh the DataTable
                    $('#myTable').DataTable().ajax.reload();
                },
                error: function(error) {
                    console.error('Error deleting aliment:', error);
                }
            });
        }
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
        </tr>
    </thead>

</table>
</body>
</html>