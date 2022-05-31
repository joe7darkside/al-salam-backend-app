$(document).ready(function() {

    $(document).on('click', '.deleteBtn', function() {

        var bill_id = $(this).val();
        // alert(captain_id);
        $('#deleteModal').modal('show');
        $('#delete_bill_id').val(bill_id);
    });

    $(document).on('click', '.createBtn', function() {

        var bill_id = $(this).val();
        // alert(captain_id);
        $('#createModal').modal('show');
        $('#create_bill_id').val(bill_id);
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
                $('#bill_id').val(bill_id);

                $('#gas_bill').val(response.bill.gas_bill.cost);
                $('#water_bill').val(response.bill.water_bill.cost);
                $('#electricity_bill').val(response.bill.electricity_bill.cost);
                $('#payment_date').val(response.bill.payment_date);
                $('#payment_status').val(response.bill.payment_status);

            }
        });
    });
})