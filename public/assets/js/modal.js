 $(document).ready(function() {
     $(document).on('click', '.editBtn', function() {

         var id = $(this).val();
         alert(id);
         //  console.log(slider_id);
         //  $('#editModal').modal('show');
         $.ajax({
             type: "GET",
             url: "/sliders/edit/" + id,
             success: function(response) {
                 //  $('#title_en').val(response.slider.title_en);
                 //  $('#title_ar').val(response.slider.title_ar);
                 //  $('#description_en').val(response.slider.description_en);
                 //  $('#description_ar').val(response.slider.description_ar);
                 //  $('#type').val(response.slider.type);
                 //  $('#img').val(response.slider.img);
                 //  $('#id').val(response.slider.id);
                 console.log(response.slider.id);

             }
         });
     });


     $(document).on('click', '.createBtn', function() {

         $('#createModal').modal('show');

     });
     // Send success response 
     $(document).on('click', '.sendSuccessBtn', function() {

         $('#sendModal').modal('show');

     });

     // Send response 
     $(document).on('click', '.sendBtn', function() {

         $('#sendModal').modal('show');

     });

 });