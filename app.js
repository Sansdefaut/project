$(document).ready(function(){
  $(document).on('submit', '#LoginForm', function(event2) {
        event2.preventDefault();

        document.getElementById("alert_message_success4").style.display = "none";
        document.getElementById("alert_message_warning4").style.display = "none";
        document.getElementById("alert_message_danger4").style.display = "none";

        var username = $('#username').val();
         var passwords = $('#passwords').val();

        if (username != '' && passwords != '') {
            // Show loading state
            $('#kalisa4').text('Uploading...').prop('disabled', true);

            $.ajax({
                url: "http://localhost/newstore/include/login-html",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    $('#kalisa4').text('Login').prop('disabled', false); // Reset button

                    if (data.error) {
                        document.getElementById("alert_message_danger4").style.display = "block";
                        $('#alert_message_danger4').html(data.message); // Corrected message handling
                    } else {
                        document.getElementById("kalisa4").style.display = "none";
                        document.getElementById("alert_message_success4").style.display = "block";
                        $('#alert_message_success4').html(data.message);

                        setTimeout(function() {
                            location.reload(true); // Force reload from server
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    $('#kalisa4').text('Login').prop('disabled', false); // Reset button on error
                    document.getElementById("alert_message_danger4").style.display = "block";
                    $('#alert_message_danger4').html("An error occurred. Please try again.");
                }
            });
        } else {
            document.getElementById("alert_message_warning4").style.display = "block";
            $('#alert_message_warning4').html("All fields are required");
        }
    });


  $(document).on('submit', '#RegisterFormNow', function(event3) {
        event3.preventDefault();

        document.getElementById("alert_message_success3").style.display = "none";
        document.getElementById("alert_message_warning3").style.display = "none";
        document.getElementById("alert_message_danger3").style.display = "none";

         var firstname = $('#firstname').val();
         var lastname = $('#lastname').val();
         var phonenumber = $('#phonenumber').val();
         var email = $('#email').val();
         var password = $('#password').val();
        

        if (firstname  != '' && lastname  != '' && phonenumber != ''  && email != '' && passwords != '') {
            // Show loading state
            $('#kalisa3').text('Uploading...').prop('disabled', true);

            $.ajax({
                url: "http://localhost/newstore/include/register-html",
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(data) {
                    $('#kalisa3').text('Register').prop('disabled', false); // Reset button

                    if (data.error) {
                        document.getElementById("alert_message_danger3").style.display = "block";
                        $('#alert_message_danger3').html(data.message); // Corrected message handling
                    } else {
                        document.getElementById("kalisa3").style.display = "none";
                        document.getElementById("alert_message_success3").style.display = "block";
                        $('#alert_message_success3').html(data.message);

                        setTimeout(function() {
                            location.reload(true); // Force reload from server
                        }, 1000);
                    }
                },
                error: function(xhr, status, error) {
                    $('#kalisa3').text('Register').prop('disabled', false); // Reset button on error
                    document.getElementById("alert_message_danger3").style.display = "block";
                    $('#alert_message_danger3').html("An error occurred. Please try again.");
                }
            });
        } else {
            document.getElementById("alert_message_warning3").style.display = "block";
            $('#alert_message_warning3').html("All fields are required");
        }
    });
  

   });
