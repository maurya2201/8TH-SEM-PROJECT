$(document).ready(function () {
    $("#register").validate({
      rules: {
        fullname: {
          required: true,
          minlength: 2,
        },
        email: {
          required: true,
          email: true,
        },
        password: {
          required: true,
          minlength: 8,
        },
        confirmpassword: {
          required: true,
          minlength: 8,
        },
        mobilenumber: {
          required: true,
          minlength: 10,
          maxlength: 10,
        },
        userType: "required",
      },
      messages: {
        fullname: {
          required: "<b><p class='error'>Please enter fullname.</p></b>",
          minlength: "<b><p class='error'>Minimum 2 character required.</p></b>",
        },
        email: {
          required: "<b><p class='error'>Please enter email.</p></b>",
          email: "<b><p class='error'>Please enter a valid email.</p></b>",
        },
        password: {
          required: "<b><p class='error'>Please enter password.</p></b>",
          minlength:
            "<b><p class='error'>Minimum 8 characters are required.</p></b>",
        },
        confirmpassword: {
          required: "<b><p class='error'>Please enter confirmpassword.</p></b>",
          minlength:
            "<b><p class='error'>Minimum 8 characters are required.</p></b>",
        },
        mobilenumber: {
          required: "<b><p class='error'>Please enter phonenumber.</p></b>",
          minlength:
            "<b><p class='error'>Minimum 10 numbers are required.</p></b>",
          maxlength:
            "<b><p class='error'>Maximum 10 numbers are required.</p></b>",
        },
        userType: "<b><p class='error'>Please select role</p></b>",
      },
    });
});
  