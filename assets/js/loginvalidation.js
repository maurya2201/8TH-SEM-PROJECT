$(document).ready(function(){
  $('#login').validate({
  rules:{
  email:{
  required:true,
  email:true
  },
  password:{
    required:true,
    minlength:8
  }},
  messages:{
  email:{
    required:"<b><p class='error'>Please enter email</p></b>",
    email:"<b><p class='error'>Please enter valid email</p></b>",
  },
  password:{
  required:"<b><p class='error'>Please enter password</p></b>",
  minlength:"<b><p class='error'>Please enter password of 8 characters</p></b>"
  }},
  });
});