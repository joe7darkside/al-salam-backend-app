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
                console.log(response);
                $('#title_en').val(response.notification.title_en);
                $('#title_ar').val(response.notification.title_ar);
                $('#description_en').val(response.notification.description_en);
                $('#description_ar').val(response.notification.description_ar);
                $('#notification_id').val(notification_id);



            }
        });
    });
})