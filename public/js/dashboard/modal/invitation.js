$(document).ready(function() {

    $(document).on('click', '.deleteBtn', function() {

        var notification_id = $(this).val();
        // alert(notification_id);
        $('#deleteModal').modal('show');
        $('#delete_notification_id').val(notification_id);
    });

    $(document).on('click', '.editBtn', function() {
        var notification_id = $(this).val();
        // alert(notification_id);
        // console.log(notification_id);
        $('#editModal').modal('show');
        $.ajax({
            type: "GET",
            url: "/notifications/edit/" + notification_id,
            success: function(response) {
                console.log(response.notification.id);
                $('#title').val(response.notification.title);
                // $('#title_ar').val(response.notification.title_ar);
                $('#description').val(response.notification.description);
                // $('#description_ar').val(response.notification.description_ar);
                $('#_id').val(response.notification.id);



            }
        });
    });

    $(document).on('click', '.infoBtn', function() {

        var invitation_id = $(this).val();
        $('#infoModal').modal('show');
        $('#info_id').val(invitation_id);

        $.ajax({
            type: "GET",
            url: "/invitations/edit/" + invitation_id,
            success: function(response) {

                console.log(response);
                var user_first_name = response.user.first_name
                var user_last_name = response.user.last_name
                var user_email = response.user.email
                var user_phone = response.user.phone
                var user_block = response.user.block
                var user_unit = response.user.unit
                var guest = response.guest_name

                $('#guest_name').html(guest);
                $('#user_email').html(user_email);
                $('#user_phone').html(user_phone);
                $('#user_block').html(user_block);
                $('#user_unit').html(user_unit);
                $('#user_name').html(user_first_name + " " + user_last_name);


            }
        });
    });

    $(document).on('click', '.actionBtn', function() {

        var invitation_id = $(this).val();
        $('#actionModal').modal('show');
        $('#action_id').val(invitation_id);
        $.ajax({
            type: "GET",
            url: "/invitations/edit/" + invitation_id,
            success: function(response) {

                console.log(response);
                var first_name = response.user.first_name
                var last_name = response.user.last_name

                $('#name').html(first_name + " " + last_name);
                // console.log(response.user.first_name);


            }
        });
    });



})