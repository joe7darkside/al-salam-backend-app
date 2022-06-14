$(document).ready(function() {


    $(document).on('click', '.infoBtn', function() {
        var trip_id = $(this).val();
        // alert(trip_id);
        // console.log(captain_id);
        $('#infoModal').modal('show');
        // $('#trip_id').val(trip_id);
        $.ajax({
            type: "GET",
            url: "/trips/show/" + trip_id,
            success: function(response) {
                console.log(response);

                var captainFullName = response.captain.first_name + " " + response.captain.last_name;
                var captainPhone = response.captain.phone;
                var captainEmail = response.captain.email;
                var pickUp = "U-" + response.pick_up.block + " " + "B-" + response.pick_up.unit;
                var dropOf = "U-" + response.drop_of.block + " " + "B-" + response.drop_of.unit;
                var paymentMethod = "";

                switch (response.payment_method) {
                    case 0:
                        paymentMethod = "Cash";
                        // console.log(paymentMethod);
                        break;
                    case 1:
                        paymentMethod = "Visa Card";
                        // console.log(paymentMethod);
                        break;
                    case 2:
                        paymentMethod = "Al Salam Card";
                        // console.log(paymentMethod);
                        break;
                    default:
                        // console.log(paymentMethod);
                        break;
                }

                // console.log(paymentMethod);
                $('#captain_name').html(captainFullName);
                $('#captain_phone').html(captainPhone);
                $('#captain_email').html(captainEmail);
                $('#pick_up').html(pickUp);
                $('#drop_of').html(dropOf);
                $('#payment_method').html(paymentMethod);

                var img = 'http://127.0.0.1:8000/' + response.captain.img;
                document.getElementById("captain_img").src = img;



            }
        });
    });
})