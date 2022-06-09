$(document).ready(function() {

    $(document).on('click', '.deleteBtn', function() {

        var bill_id = $(this).val();
        // alert(captain_id);
        $('#deleteModal').modal('show');
        $('#delete_bill_id').val(bill_id);
    });

    // $(document).on('click', '.createBtn', function() {

    //     var bill_id = $(this).val();
    //     // alert(captain_id);
    //     $('#createModal').modal('show');
    //     $('#create_bill_id').val(bill_id);
    // });

    $(document).on('click', '.createBtn', function() {

        var bill_id = $(this).val();
        // alert(captain_id);
        $('#createModal').modal('show');
        $('#bill_id').val(bill_id);
    });





    $(document).on('click', '.editBtn', function() {
        var bill_id = $(this).val();
        // alert(bill_id);
        // console.log(captain_id);
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/bills/edit/" + bill_id,
            success: function(response) {

                console.log(response);
                $('#bill_id').val(bill_id);
                // $('#block').val(response.block);
                // $('#unit').val(response.unit);
                $('#payment_from').val(response.payment_from);
                $('#payment_to').val(response.payment_to);
                $('#gas_bill').val(response.gas_bill.cost);
                $('#water_bill').val(response.water_bill.cost);
                $('#electricity_bill').val(response.electricity_bill.cost);
                $('#payment_due').val(response.payment_due);
                $('#payment_status').val(response.payment_status);

            }
        });
    });
})