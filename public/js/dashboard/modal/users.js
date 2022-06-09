$(document).ready(function() {

    $(document).on('click', '.deleteBtn', function() {

        var user_id = $(this).val();
        // alert(user_id);
        $('#delete_User_Modal').modal('show');
        $('#delete_user_id').val(user_id);
    });
    $(document).on('click', '.createBtn', function() {

        var bill_id = $(this).val();
        // alert(captain_id);
        $('#createModal').modal('show');
        $('#create_bill_id').val(bill_id);
    });



    $(document).on('click', '.sendBtn', function() {

        var user_id = $(this).val();
        // alert(user_id);
        $('#send_User_Modal').modal('show');
        $('#send_user_id').val(user_id);
    });



    $(document).on('click', '.editBtn', function() {
        var user_edit_id = $(this).val();
        // alert(captain_id);
        // console.log(captain_id);
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/users/edit/" + user_edit_id,
            success: function(response) {

                $('#first_name').val(response.user.first_name);
                $('#last_name').val(response.user.last_name);
                $('#phone').val(response.user.phone);
                $('#email').val(response.user.email);
                $('#block').val(response.user.block);
                $('#unit').val(response.user.unit);
                // $('#password').val(response.bill.password);
                // $('#vehicle').val(response.bill.vehicle);
                // $('#licence_plate').val(response.captain.vehicle);
                // $('#rate').val(response.captain.rate);
                $('#user_edit_id').val(user_edit_id);


            }
        });
    });
})