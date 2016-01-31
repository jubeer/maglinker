function validateform() {
    var lg = document.forms["validForm"]["login"].value;
    var p1 = document.forms["validForm"]["pass1"].value;
    var p2 = document.forms["validForm"]["pass2"].value;
    var em = document.forms["validForm"]["email"].value;
    var ch = document.forms["validForm"]["checkbox"].value;
    var bot = document.forms["validForm"]["ch_bot"].value;
    var errMsgHolder = document.getElementById('nameErrMsg');
    var errMsgHolder2 = document.getElementById('nameErrMsg2');
    var errMsgHolder3 = document.getElementById('nameErrMsg3');
    var errMsgHolder4 = document.getElementById('nameErrMsg4');
    var errMsgHolder5 = document.getElementById('nameErrMsg5');
    var errMsgHolder5 = document.getElementById('nameErrMsg6');

    if (lg  == null || lg == "") {
        errMsgHolder.innerHTML = 'LOGIN must be filled!';
    } else if (!(/^\S{3,}$/.test(lg))){
        errMsgHolder.innerHTML = 'LOGIN cannot contain whitespaces!';
    }

    if (ln == null || ln == "") {
        errMsgHolder2.innerHTML = 'LAST NAME must be filled!';
    } else if (!(/^\S{3,}$/.test(ln))){
        errMsgHolder2.innerHTML = 'LAST NAME cannot contain whitespaces!';
    }
    //e-mail
    reg = /^[a-zA-Z0-9ąćęłńóśżźĄĆĘŁŃÓŚŻŹ]{1,30}@[a-zA-Z0-9ąćęłńóśżźĄĆĘŁŃÓŚŻŹ]+(\.[a-zA-Z0-9ąćęłńóśżźĄĆĘŁŃÓŚŻŹ]+)+$/;
    spr = em.match(reg);
    if (spr == null) {
        errMsgHolder3.innerHTML = 'E-MAIL syntax error!';
    } else if (!(/^\S{3,}$/.test(em))){
        errMsgHolder3.innerHTML = 'E-MAIL cannot contain whitespaces!';
    }

    if (zc == null || zc == "") {
        errMsgHolder4.innerHTML = 'ZIP CODE must be filled!';
    } else if (!(/^\S{3,}$/.test(zc))){
        errMsgHolder4.innerHTML = 'ZIP CODE cannot contain whitespaces!';
    } else if (zc.length < 5) {
        errMsgHolder4.innerHTML = 'ZIP CODEE has to be 5 digits at least!';
    }

    if (cn == null || cn == "" || cn < 0) {
        errMsgHolder5.innerHTML = 'CHILDREN must be filled and above value 0!';
        return false;
    }
    return true;

}