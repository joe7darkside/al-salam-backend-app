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

    $(document).on('click', '.sendBtn', function() {

        var notification_id = $(this).val();
        $('#sendModal').modal('show');
        $('#notification_id').val(notification_id);
    });


    // $(document).on('click', '.sendBtn', function() {
    //     var notification_id = $(this).val();
    //     // alert(notification_id);
    //     // console.log(notification_id);
    //     $('#sendModal').modal('show');
    //     $.ajax({
    //         type: "GET",
    //         url: "/notifications/show/" + notification_id,
    //         success: function(response) {
    //             // console.log(response);
    //             $('#notification_id').val(notification_id);
    //         }
    //     });
    // });
})