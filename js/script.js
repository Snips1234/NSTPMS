// $(document).on("click", ".open-view-modal", function() {
//   var std_id = $(this).data('id');
//   var table_name = $(this).data('table');
//   var type = $(this).data('type');

  
//   $.ajax({
//     type: "post",
//     url: "get_student_details.php",
//     data: { std_id: std_id, table_name:table_name, type:type },
//     dataType: "text",
//     success: function(response) {
//       $(".modal-body").html(response);
//     },
//     error: function(request, status, error) {
//       $(".modal-body").html(request.responseText);
//     }
//   });
// });


$(document).on("click", ".open-view-modal", function() {
  var std_id = $(this).data('id');
  var table_name = $(this).data('table');
  var type = $(this).data('type');
  
  $.ajax({
    type: "post",
    url: "get_student_details.php",
    data: { std_id: std_id, table_name: table_name, type: type },
    dataType: "text",
    success: function(response) {
      $(".modal-body").html(response);
    },
    error: function(request, status, error) {
      $(".modal-body").html(request.responseText);
    }
  });
});

$(document).on("click", ".open-delete-modal", function() {
  var std_id = $(this).data('id');
  var table = $(this).data('table');
  
  // Clear the modal body content to avoid leftover content from the view modal
  $("#delete_modal .modal-body").html("");
  $(".modal-body").html('<h3>Are you sure you want to delete this user?</h3>');
  // Set the values for the delete operation
  $("#std_id").val(std_id);
  $("#table_name").val(table);
});


$('#view_modal').on('hidden.bs.modal', function () {
    $(this).find('.modal-body').html('');
});


function showError(message) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-end",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.error(message);
}

function showWarning(message) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-end",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.warning(message);
}

function showSuccess(message) {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-end",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "3000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    toastr.success(message);
}
