$(document).ready(function() {

    $(document).on('click', '.deleteBtn', function() {

        var user_id = $(this).val();
        // alert(captain_id);
        $('#deleteModal').modal('show');
        $('#delete_user_id').val(user_id);
    });
    $(document).on('click', '.createBtn', function() {

        var bill_id = $(this).val();
        // alert(captain_id);
        $('#createModal').modal('show');
        $('#create_bill_id').val(bill_id);
    });
    // {{ route('user.delete') }}
    // $(document).on('click', '.sendBtn', function() {

    //     var user_id = $(this).val();
    //     // alert(captain_id);
    //     $('#sendModal').modal('show');
    //     // $('#delete_user_id').val(user_id);
    // });




    $(document).on('click', '.editBtn', function() {
        var bill_id = $(this).val();
        // alert(captain_id);
        // console.log(captain_id);
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/bills/edit/" + bill_id,
            success: function(response) {

                $('#payment_date').val(response.bill.payment_date);
                $('#last_name').val(response.bill.last_name);
                $('#phone').val(response.bill.phone);
                $('#email').val(response.bill.email);
                $('#password').val(response.bill.password);
                $('#vehicle').val(response.bill.vehicle);
                $('#licence_plate').val(response.captain.vehicle);
                $('#rate').val(response.captain.rate);
                $('#captain_id').val(captain_id);


            }
        });
    });
})