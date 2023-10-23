$(document).ready(function) {
    // Initialize Datatable
    let table = new DataTable('#userTable');

    $.ajax({
        url: 'http://localhost/IDAW/TP4/exo5/users.php',
        type: 'GET',
        datatType: 'json',
    })
    
    .done(function(response){
        response.foreach(function(user){
            
        })
    })
}


    

// Example Ajax for adding a user
/*$('#addUserBtn').on('click', function() {
    $.ajax({
        url: 'http://localhost/IDAW/TP4/exo5/users.php',
        type: 'GET',
        data: {/* Data from your form /},
        success: function(response) {
            // Handle success, e.g., update Datatable
            $('#userTable').DataTable().ajax.reload();
        },
        error: function(error) {
            // Handle error, e.g., display error message to the user
            console.error('Error adding user:', error);
        }
    });*/





