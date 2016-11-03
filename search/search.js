function validate(event)
{
    var flag = true;
    var reg_name = /^[\w.-]+$/;
    var reg_email = /^(\w-*)+(\.\w+)*$/;
    var reg_ut = /^\w+\.\w+$/;
    
    if(this.wechatName.value == "") {
        document.getElementById("nameErr").innerHTML = "* You must enter a name";
        flag = false;
    } else if(!reg_name.test(this.wechatName.value)) {
        document.getElementById("nameErr").innerHTML = "* 只能填写字母、数字、下划线";
        flag = false;
    } else document.getElementById("nameErr").innerHTML = "*";

    if(this.email.value == "") {
        document.getElementById("emailErr").innerHTML = "* You must enter an email";
        flag = false;
    } else if(!reg_email.test(this.email.value)) {
        document.getElementById("emailErr").innerHTML = "* Invalid email";
        flag = false;
    } else if(!reg_ut.test(this.email.value)) {
        document.getElementById("emailErr").innerHTML = "* Not a valid UofT email";
        flag = false;
    } else document.getElementById("emailErr").innerHTML = "*";
    
   
    if(!flag)
        document.getElementById("submitErr").innerHTML = "Please check your information and try again.";
    else {
        document.getElementById("submitErr").innerHTML = "";
        document.getElementById("submitting").innerHTML = "Submitting...";
        document.getElementById("submit").disabled = true;
    }
    if(!flag) event.preventDefault();
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
    email = email.substring(0, email.indexOf('@'));

    if(name != "") {
        document.getElementById("wechatName").value = name;
        document.getElementById("email").value = email;
    }
}

autoFill();
document.getElementById("form").onsubmit = function (event) {validate(event);}
