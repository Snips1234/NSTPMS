$(document).ready(function(){
  $.validator.addMethod("regex", function(value, element, regexp) {
    var re = new RegExp(regexp);
    return this.optional(element) || re.test(value);
  }, "Invalid value.");

  $.validator.addMethod('validNumber', function(value, element) {
    value = $.trim(value);
    var contactNumberRegex = /^\d{11}$/;
    return this.optional(element) || contactNumberRegex.test(value);
  }, 'Please enter a valid number.');

  $.validator.addMethod("usernameUnique", function(value, element) {
    var isSuccess = false;

    $.ajax({
        type: "POST",
        url: "checkUsername.php", 
        data: {username:value}, 
        dataType: "json",
        async: false,
        success: function(response) {
          isSuccess = response.status == 'available';
        }
    });
    return isSuccess;
  }, "Username already exists.");

  $('#sign-up-form').validate({
    rules: {
            'first-name': {
              required: true,
              minlength: 2,
              maxlength: 20
            },
            'middle-name': {
              required: true,
              minlength: 2,
              maxlength: 20
            },
            'last-name': {
              required: true,
              minlength: 2,
              maxlength: 20
            },
            'name-extension': {
              required: true,
              minlength: 2,
              maxlength: 20
            },
            'birthday': {
              required: true,
              date: true
            },
            'gender': {
              required: true,
            },
            'address-street-barangay': {
              required: true,
              minlength:2
            },
            'address-municipality': {
              required: true,
              minlength:2
            },
            'address-province': {
              required: true,
              minlength:2
            },
            'civil-status': {
              required: true,
            },
            'religion': {
              required: true,
              minlength:2
            },
            'contact-number': {
              required: true,
              minlength:11,
              maxlength:11,
              validNumber:true
            },
            'email': {
              required: true,
              email: true
            },
            'college': {
              required: true,
            },
            'year-level': {
              required: true,
            },
            'course': {
              required: true,
              minlength:2
            },
            'major': {
              required: true,
              minlength:2
            },
            'contact-person-name': {
              required: true,
              minlength:2
            },
            'contact-person-number': {
              required: true,
              minlength:11,
              maxlength:11,
              validNumber:true
            },
            'username': {
              required: true,
              minlength:2,
              usernameUnique: true
            },
            'password': {
              required: true,
              minlength: 8,
              regex: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/
            },
            'confirm-password': {
              required: true,
              equalTo: '#password'
            }
    },
    errorPlacement: function(error, element) {
      error.appendTo(element.closest('.control').find('.error-container'));
    },
    highlight: function(element) {
      $(element).removeClass('is-valid').addClass('is-invalid');
    },
    unhighlight: function(element) {
      $(element).removeClass('is-invalid').addClass('is-valid');
    },
    submitHandler: function(form) {
      form.submit();
    }
  });

  // console.log('got thru');
});

$(document).ready(function() {
  $('#login-form').validate({
    rules: {
      'username': {
        required: true,
        minlength: 2,
      },
      'password': {
        required: true,
        minlength: 8,
      }
    },
    errorPlacement: function(error, element) {
      error.appendTo(element.closest('.form-floating').find('.error-container'));
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});
