$(document).ready(function() {


    //* Create modal 

    $(document).on('click', '.createBtn', function() {

        // var admin_id = $(this).val();
        $('#createModal').modal('show');
    });

    //* Send modal 

    $(document).on('click', '.sendBtn', function() {

        var admin_id = $(this).val();
        $('#sendModal').modal('show');
        $('#send_admin_id').val(admin_id);
    });




    //* Delete modal 

    $(document).on('click', '.deleteBtn', function() {

        var admin_id = $(this).val();
        $('#deleteModal').modal('show');
        $('#delete_admin_id').val(admin_id);
    });


    //* Edit modal
    $(document).on('click', '.editBtn', function() {
        var admin_id = $(this).val();
        // alert(captain_id);
        // console.log(captain_id);
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/admins/edit/" + admin_id,
            success: function(response) {
                $('#admin_id').val(admin_id);
                // console.log(response.admin);
                $('#first_name').val(response.admin.first_name);
                $('#last_name').val(response.admin.last_name);
                $('#phone').val(response.admin.phone);
                $('#email').val(response.admin.email);
                $('#role').val(response.admin.role);
                console.log(response.admin.first_name);
                // $('#rate').val(response.captain.rate);



            }
        });
    });
})