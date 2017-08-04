$(document).ready(function()
{
    $("#stud").click(function()
     {   
        $(this).removeClass("user-sel-unsel");
        $("#teach").addClass("user-sel-unsel");
        $("#stud-login-form").css("display","block");
        $("#teach-login-form").css("display","none");
        console.log("Student click");
    });
});

$(document).ready(function()
{
    $("#teach").click(function()
    {
        $(this).removeClass("user-sel-unsel");
        $("#stud").addClass("user-sel-unsel");
        //$("#sub-btn").html("Teacher Login");
         //$("form").removeClass("form student-form");
        //$("form").addClass("form teacher-form");
        $("#teach-login-form").css("display","block");
        $("#stud-login-form").css("display","none");
        console.log("Teacher click");
    });
});