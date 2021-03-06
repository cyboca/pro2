// JavaScript Document
$(document).ready(function () {
    $("#showaccounts").click(function () {
        $.getJSON("accounts", function (data) {
            $("#mysqluser").val(data.mysqluser);
            $("#mysqlpass").val(data.mysqlpass);
            $("#ftpuser").val(data.ftpuser);
            $("#ftppass").val(data.ftppass);
        });
        $("#accounts").css('display','block');
        $("#main").css('webkitFilter',"blur(3px)");
    });
    $("#modifyspaceselect").change(function () {
        $.getJSON("modifyspace?"+$(this).val(),function (data) {
            $("#modifyLimit").val(data.limit);
        });
    });
});

function showModifySpace() {
    var space=document.getElementById("modifyspacediv");
    var main=document.getElementById('main');

    space.style.display="block";
    main.style.webkitFilter="blur(3px)";
}


function showDeleteSpace() {
    var space=document.getElementById('deletespacediv');
    var main=document.getElementById('main');

    space.style.display="block";
    main.style.webkitFilter = "blur(3px)";
}

function confirmDeleteSpace() {
    var msg='删除空间，该空间下所有用户部署的网站将全部删除';
    if(confirm(msg)==true){
        return true;
    }else{
        return false;
    }
}

function confirmBuild() {
    var msg='确认重新构建容器吗？已存在的容器将被删除！';
    if(confirm(msg)==true){
        return true;
    }else{
        return false;
    }
}

function closeModifySpace() {
    var spaces=document.getElementById("modifyspacediv");
    var main=document.getElementById("main");

    spaces.style.display="none";
    main.style.webkitFilter="";
}

function closeDeleteSpace() {
    var spaces=document.getElementById("deletespacediv");
    var main=document.getElementById("main");

    spaces.style.display="none";
    main.style.webkitFilter="";
}

function showspaces() {
    var spaces=document.getElementById("chosespacediv");
    var main=document.getElementById("main");

    spaces.style.display="block";
    main.style.webkitFilter = "blur(3px)";
}

function closeWindow() {
    var float1 = document.getElementById("floatTop");
    var float2 = document.getElementById("floatTopRegister");
    var main = document.getElementById("main");
    float1.style.display = "none";
    float2.style.display = "none";
    main.style.webkitFilter = "";
}

function closeaccounts() {
    var float1 = document.getElementById("accounts");
    var main = document.getElementById("main");
    float1.style.display = "none";
    main.style.webkitFilter = "";
}

function closespaces() {
    var spaces=document.getElementById("chosespacediv");
    var main=document.getElementById("main");

    spaces.style.display="none";
    main.style.webkitFilter="";
}

function showBuild() {
    var build=document.getElementById("buildDiv");
    var main=document.getElementById("main");

    build.style.display="block";
    main.style.webkitFilter = "blur(3px)";
}

function closeBuild() {
    var build=document.getElementById("buildDiv");
    var main=document.getElementById("main");

    build.style.display="none";
    main.style.webkitFilter="";
}

function showSignInWindow() {
    var float = document.getElementById("floatTop");
    var main = document.getElementById("main");
    float.style.display = "block";
    main.style.webkitFilter = "blur(3px)";

}

function showaccounts() {
    var float = document.getElementById("accounts");
    var main = document.getElementById("main");
    float.style.display = "block";
    main.style.webkitFilter = "blur(3px)"
}

function showRegisterWindow() {
    var float = document.getElementById("floatTopRegister");
    var main = document.getElementById("main");
    float.style.display = "block";
    main.style.webkitFilter = "blur(3px)"
}

function registerSignIn() {
    var float1 = document.getElementById("floatTop");
    var float2 = document.getElementById("floatTopRegister");
    float2.style.display = "none";
    float1.style.display = "block";
}

function signInRegister() {
    var float1 = document.getElementById("floatTop");
    var float2 = document.getElementById("floatTopRegister");
    float2.style.display = "block";
    float1.style.display = "none";
}

function jumpto() {
    var page = document.getElementById('jumpto').value;
    window.location.href = "?page=" + page;
}

function validcheck() {
    var username = document.forms['register']['reg_username'].value;
    var password = document.forms['register']['reg_password'].value;

    var userreg = RegExp(/^[a-zA-Z\_]{1}[a-zA-Z0-9\_]{5,7}$/);
    var passreg = RegExp(/^[a-zA-Z0-9@#$%^&*()?<>.!\-\_+=]{8,12}$/);
    if (username.match(userreg)) {
        if (password.match(passreg)) {
            return true;
        } else {
            alert("pass false!password length 8-12");
            return false;
        }
    } else {
        alert("user false!username length 6-8");
        return false;
    }
}

function mysqlchange() {
    var ps = document.getElementById("mysqlpass");
    var img = document.getElementById("mysqlvisible");
    if (ps.type == "password") {
        ps.type = "text";
        img.src = "../img/invisible.png";
    } else {
        ps.type = "password";
        img.src = "../img/visible.png";
    }
}

function ftpchange() {
    var ps = document.getElementById("ftppass");
    var img = document.getElementById("ftpvisible");
    if (ps.type == "password") {
        ps.type = "text";
        img.src = "../img/invisible.png";
    } else {
        ps.type = "password";
        img.src = "../img/visible.png";
    }
}

function showAddUser() {
    var float=document.getElementById('addUser');
    var main=document.getElementById('main');

    float.style.display = "block";
    main.style.webkitFilter = "blur(3px)";
}

function managerCloseWindow() {
    var float1 = document.getElementById("addUser");
    var main = document.getElementById("main");
    float1.style.display = "none";
    main.style.webkitFilter = "";
}

function test() {
    alert('test');
}
