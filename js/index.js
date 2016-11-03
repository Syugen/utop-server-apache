function validateAll(event) {
    var flag = true;
    flag = validateName();
    flag = validateEmail();
    flag = validateCourse();
    flag = validatePolicy();
    validateResult(event, flag);
}

function validateNameEmail(event)
{
    var flag = true;
    flag = validateName();
    flag = validateEmail();
    validateResult(event, flag);
}

function validateName() {
    var flag = true;
    var reg_name = /^[\w.-]+$/;
    if(this.wechatName.value == "") {
        document.getElementById("nameErr").innerHTML = "* 微信名不能为空";
        flag = false;
    } else if(!reg_name.test(this.wechatName.value)) {
        document.getElementById("nameErr").innerHTML = "* 只能填写字母、数字、下划线";
        flag = false;
    } else document.getElementById("nameErr").innerHTML = "*";
    return flag;
}

function validateEmail() {
    var flag = true;
    var reg_email = /^(\w-*)+(\.\w+)*@(\w)+((\.\w+)+)$/;
    var reg_ut = /^\w+\.\w+@mail.utoronto.ca$/;
    if(this.email.value == "") {
        document.getElementById("emailErr").innerHTML = "* 邮箱不能为空";
        flag = false;
    } else if(!reg_email.test(this.email.value)) {
        document.getElementById("emailErr").innerHTML = "* 无效邮箱";
        flag = false;
    } else if(!reg_ut.test(this.email.value)) {
        document.getElementById("emailErr").innerHTML = "* 非U of T邮箱";
        flag = false;
    } else document.getElementById("emailErr").innerHTML = "*";
    return flag;
}

function validateCourse() { 
    if(this.course.selectedIndex == 0) {
        document.getElementById("courseErr").innerHTML = "* 请选择课程";
        return false;
    } else document.getElementById("courseErr").innerHTML = "*";
    return true;
}

function validatePolicy() {
    if(this.policy.checked == false) {
        document.getElementById("policyErr").innerHTML = "* 请勾选同意";
        return false;
    } else document.getElementById("policyErr").innerHTML = "";
    return true;
}

function validateResult(event, flag) {
    if(!flag) {
        document.getElementById("submitErr").innerHTML = "请检查后再试一次";
        event.preventDefault();
    } else {
        document.getElementById("submitErr").innerHTML = "";
        document.getElementById("submitting").innerHTML = "提交中...";
        document.getElementById("submit").disabled = true;
    }
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

function autoFill(flag) {
    var name = getCookie("utopRememberName");
    var email = getCookie("utopRememberEmail");

    if(name != "") {
        document.getElementById("wechatName").value = name;
        document.getElementById("email").value = email;
        if(flag) {
            var course = getCookie("utopRememberCourse");
            document.getElementById("course").value = course;
            document.getElementById("remember").checked = true;
        }
    }
}
