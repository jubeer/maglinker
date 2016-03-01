function validateLogin() {
    var lg = document.forms["myForm"]["login"].value;
    var ps = document.forms["myForm"]["pass"].value;
    var errMsg = document.getElementById('errMsg');
    var errPass = document.getElementById('errPass');

    if (lg == null || lg == "") {
        errMsg.innerHTML = 'LOGIN must be filled!';
        return false;
    } else if (!(/^\w+$/.test(lg))) {
        errMsg.innerHTML = 'LOGIN cannot contain whitespaces!';
        return false;
    } else {
        errMsg.innerHTML = '';
    }

    if (ps == null || ps == "") {
        errPass.innerHTML = 'PASSWORD must be filled!';
        return false;
    }else {
        errPass.innerHTML = '';
    }
    return true;
}

function validateSignup() {
    var un = document.forms["signupForm"]["username"].value;
    var em = document.forms["signupForm"]["email"].value;
    var pwd1 = document.forms["signupForm"]["pass1"].value;
    var pwd2 = document.forms["signupForm"]["pass2"].value;
    var chkbx = document.forms["signupForm"]["reg"].checked;
    var errMsg = document.getElementById('errMsg');
    var errEM = document.getElementById('errEM');
    var errPwd = document.getElementById('errPwd');
    var errChkbx = document.getElementById('errChkbx');


    if (un == null || un == "") {
        errMsg.innerHTML = 'LOGIN must be filled!';
        return false;
    } else if (!(/^\w+$/.test(un))) {
        errMsg.innerHTML = 'LOGIN cannot contain whitespaces!';
        return false;
    } else {
        errMsg.innerHTML = '';
    }


    if (pwd1 != "" && pwd1 == pwd2) {
        if (pwd1.length < 8) {
            errPwd.innerHTML = 'PASSWORD must contain at least 8 characters!';
            return false;
        }

        if (pwd1 == un) {
            errPwd.innerHTML = 'Password must be different from Username!';
            return false;
        }

        re = /[0-9]/;
        if (!re.test(pwd1)) {
            errPwd.innerHTML = 'PASSWORD must contain at least 1 number (0-9)!';
            return false;
        }

        re = /[a-z]/;
        if (!re.test(pwd1)) {
            errPwd.innerHTML = 'PASSWORD must contain at least 1 lowercase letter (a-z)!';
            return false;
        }

        re = /[A-Z]/;
        if (!re.test(pwd1)) {
            errPwd.innerHTML = 'PASSWORD must contain at least 1 uppercase letter (A-Z)!';
            return false;
        }
    } else {
        errPwd.innerHTML = 'Please check that you have entered and confirmed your password!';
        return false;
    }

    errPwd.innerHTML = '';

    if (em != "") {
        re = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        if (!re.test(em)) {
            errEM.innerHTML = 'E-MAIL syntax error!';
            return false;
        } else if (!(/^\S{3,}$/.test(em))) {
            errEM.innerHTML = 'E-MAIL cannot contain whitespaces!';
            return false;
        }

    } else {
        errEM.innerHTML = 'E-MAIL must be filled!';
        return false;
    }

    errEM.innerHTML = '';

    if (!chkbx) {
        errChkbx.innerHTML = '  Accept the Terms!';
        return false;
    } else {
        errChkbx.innerHTML = '';
    }
    /*
    var v = grecaptcha.getResponse();
    if(v.length == 0)
    {
        document.getElementById('captcha').innerHTML="You can't leave Captcha Code empty";
        return false;
    }
    if(v.length != 0)
    {
        document.getElementById('captcha').innerHTML="Captcha completed";
        return true;
    }
    */
    return true;
}