function validate(thisform)
{
    if(document.getElementById("submitting").innerHTML == "Submitting...") {
        document.getElementById("submitErr").innerHTML = "Please do not re-submit.";
        return false;
    }
    var flag = true
    var reg_email = /^(\w-*)+(\.\w+)*@(\w)+((\.\w+)+)$/;
    var reg_ut = /^\w+\.\w+@mail.utoronto.ca$/;
    
    if(thisform.name.value == "") {
        document.getElementById("nameErr").
            innerHTML = "* You must enter a name";
        flag = false;
    } else document.getElementById("nameErr").innerHTML = "*";
    
    if(thisform.email.value == "") {
        document.getElementById("emailErr").innerHTML = "* You must enter an email";
        flag = false;
    } else if(!reg_email.test(thisform.email.value)) {
        document.getElementById("emailErr").innerHTML = "* Invalid email";
        flag = false;
    } else if(!reg_ut.test(thisform.email.value)) {
        document.getElementById("emailErr").innerHTML = "* Not a valid UofT email";
        flag = false;
    } else document.getElementById("emailErr").innerHTML = "*";
    
    if(thisform.course.selectedIndex == 0) {
        document.getElementById("courseErr").innerHTML = "* You must choose a course";
        flag = false;
    } else document.getElementById("courseErr").innerHTML = "*";
    
    if(thisform.policy.checked == false) {
        document.getElementById("policyErr").innerHTML = "* You must agree to the policy";
        flag = false;
    } else document.getElementById("policyErr").innerHTML = "";
    
    if(!flag)
        document.getElementById("submitErr").innerHTML = "Please check your information and try again.";
    else {
        document.getElementById("submitErr").innerHTML = "";
        document.getElementById("submitting").innerHTML = "Submitting...";
        document.getElementById("submit").disabled = true;
    }
    return flag;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length,c.length);
        }
    }
    return "";
}

function autoFill() {
    var name = getCookie("utopRememberName");
    var email = getCookie("utopRememberEmail");
    var course = getCookie("utopRememberCourse")
    if(name != "") {
        document.getElementById("name").value = name;
        document.getElementById("email").value = email;
        document.getElementById("course").value = course;
        document.getElementById("remember").checked = true;
    }
}

autoFill();