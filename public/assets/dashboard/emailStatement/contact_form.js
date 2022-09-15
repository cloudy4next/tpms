$(document).ready(function() {
    $("#submit").click(function() {
    var name = $("#subject").val();
    var email = $("#email").val();
    var email2 = $("#email2").val();
    var emailcc = $("#cc").val();
    var message = $("#message").val();
    var myfile = $("#myfile").val();
    $("#returnmessage").empty(); // To empty previous error/success message.
    // Checking for blank fields.
    if (name == '' || email == '' || myfile == '') {
    alert("Please Fill Required Fields");
    } else {
        console.log(emailcc ,emailbcc,email, email2, myfile,name,message,myfile )
    // Returns successful data submission message when the entered information is stored in database.
    $.post("contact_form.php", {
    name1: name,
    email1: email,
    email2: email2,
    emailcc1: emailcc,
    emailbcc1: emailbcc,
    message1: message,
    contact1: myfile
    }, function(data) {
    $("#returnmessage").append(data); // Append returned message to message paragraph.
    if (data == "Your Query has been received, We will contact you soon.") {
    $("#form")[0].reset(); // To reset form fields on success.
    }
    });
    }
    });
    });

   