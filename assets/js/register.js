
/*---------------------------------------------------------------------------  
 below we're basically creating jquery element --> when the first created element is clicked (class hideLogin) hide loginForm text and show registerForm text when the second is cliced (class hideRegister) hide registerForm text and show loginForm text
------------------------------------------------------------------------------
*/

// when the page is ready all the dependencies are loaded
$(document).ready(function() {
    
    $(".hideLogin").click(function() {
        $("#loginForm").hide();
        $("#registerForm").show();
    });

    $(".hideRegister").click(function() {
        $("#loginForm").show();
        $("#registerForm").hide();
    });
})