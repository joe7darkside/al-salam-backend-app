$(document).ready(function() {


    $(document).on('click', '.infoBtn', function() {
        var trip_id = $(this).val();
        alert(trip_id);
        // console.log(captain_id);
        // $('#infoModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/trips/info/" + trip_id,
            success: function(response) {
                $('#trip_id').val(trip_id);



            }
        });
    });
})