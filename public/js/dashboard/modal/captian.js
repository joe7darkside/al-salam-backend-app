// $(document).ready(function() {
//     var table = ('#datatable').DataTable();
//     // Start Edit Record
//     table.on('click', '.edit', function() {
//         $('#editModal').modal('show');
//         $tr = $(this).closest('tr');
//         if ($($tr).hasClass('child')) {
//             $tr = $tr.prev('.parent');
//         }
//         var data = table.row($tr).data();
//         console.log(data);
//         $('#fname').val(data[1]);
//         $('#1name').val(data[2]);
//         $('#address').val(data[3]);
//         $('#mobile').val(data[4]);
//         $('#editForm').attr('action', '/employee/' + data[0]);

//     });
//     // End Edit Record
// });

$(document).ready(function() {

    $(document).on('click', '.deleteBtn', function() {

        var captain_id = $(this).val();
        // alert(captain_id);
        $('#deleteModal').modal('show');
        $('#delete_captain_id').val(captain_id);
    });


    $(document).on('click', '.editBtn', function() {
        var captain_id = $(this).val();
        // alert(captain_id);
        // console.log(captain_id);
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/captains/edit/" + captain_id,
            success: function(response) {
                console.log(response.captain);
                $('#first_name').val(response.captain.first_name);
                $('#last_name').val(response.captain.last_name);
                $('#phone').val(response.captain.phone);
                $('#email').val(response.captain.email);
                $('#password').val(response.captain.password);
                $('#vehicle').val(response.captain.vehicle);
                $('#licence_plate').val(response.captain.vehicle);
                $('#rate').val(response.captain.rate);
                // $('#img').val(response.captain.img);
                $('#captain_id').val(captain_id);
                //    {
                //     "id": 2,
                //     "first_name": "Cristal Stark II",
                //     "last_name": "Isac Dooley",
                //     "phone": "+1.551.571.9027",
                //     "email": "trent80@hotmail.com",
                //     "password": "=\\7|\"$mt&|<qH[,C{~{M",
                //     "vehicle": "Dr. Tre Kiehn",
                //     "licence_plate": "Shanny Grimes I",
                //     "rate": 2,
                //     "created_at": "2022-05-26T22:31:41.000000Z",
                //     "updated_at": "2022-05-26T22:31:41.000000Z",
                //     "trip": []
                // }

            }
        });
    });


    $(document).on('click', '.infoBtn', function() {

        var captain_id = $(this).val();
        // alert(captain_id);
        $('#infoModal').modal('show');
        // $('#delete_captain_id').val(captain_id);
    });
})