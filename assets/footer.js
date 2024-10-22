$(document).ready(function() {
    $('#openwindow').each(function() {
        var $link = $(this);
        var $dialog = $('<div></div>')
            .load($link.attr('href'))
            .dialog({
                autoOpen: false,
                title: $link.attr('title'),
                width: 500,
                height: 300
            });

        $link.click(function() {
            $dialog.dialog('open');

            return false;
        });
    });

    //
    // Keepalive System
    //
    $.sessionTimeout({
        keepAliveUrl: 'Keepalive.do',
        logoutUrl: 'Logoff.do',
        redirUrl: 'Timeout.do',
        warnAfter: 250000,
        redirAfter: 300000,
        countdownMessage: 'Logout in {timer} seconds.',
        countdownBar: true
    });

    //
    // Submit on Enter for Login
    //
    $("#Login").keyup(function(ev) {
        // 13 is ENTER
        if (ev.which === 13) {
            document.getElementById("send").click();
        }
    });

});


function golog(mdays) {
    document.getElementById("days").value = mdays;
    document.logid.submit();
}


//
// Admin Delete a Log Entry
//
function dellog(did) {
    var ndid = document.getElementById("did");
    var fdid = document.getElementById("delid");
    ndid.value = did;
    fdid.submit();
}


//
// Edit a Log Entry
//
function editlog(eid) {
    var neid = document.getElementById("myeid");
    neid.value = eid;
    document.forms['editid'].submit();
}


//
// Edit a Log Entry Category Only
//
function editcat(eid) {
    var nceid = document.getElementById("myceid");
    nceid.value = eid;
    document.forms['editcid'].submit();
}


//
// Add or Edit a Risk Mitigation Entry
//
function risk(eid) {
    var neid = document.getElementById("rid");
    neid.value = eid;
    document.forms['riskid'].submit();
}


//
// Add or Edit Comment Entry
//
function comment(eid) {
    var neid = document.getElementById("pid");
    neid.value = eid;
    document.forms['planid'].submit();
}

//
// Mark Comment as Completed
//
function commentdone(eid) {
    var neid = document.getElementById("ccid");
    neid.value = eid;
    document.forms['completedid'].submit();
}


//
// Load the log for "x" number of days
//
function loadlog(days) {
    var xmlhttp;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
        }
    }
    var x= Math.random();
    document.getElementById("myDiv").innerHTML = "<h3>Retrieving Communication Log...Please Wait...</h3><br><img src=\"theme/app/images/loader.gif?=\"" + x + " alt=\"loading\">"
    var mystring = "Log View (" + days + " days)";
    switch (days) {
        case .666:
            document.getElementById("numdays").innerHTML = "Log View (16 hours)";
            break;
        case 1:
            document.getElementById("numdays").innerHTML = "Log View (24 hours)";
            break;
        case 0:
            document.getElementById("numdays").innerHTML = "Log View (All Entries)";
            break;
        default:
            document.getElementById("numdays").innerHTML = mystring;
    }
    xmlhttp.open("POST", "GetLog.do", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("days=" + days);
}


//
// Log Search System
//
function loadlogsearch(category) {
    var xmlhttp;
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
        }
    }
    document.getElementById("myDiv").innerHTML = "<h3>Searching Communication Log...Please Wait...</h3><br><img src=\"theme/app/images/loader.gif\" alt=\"loading\">"
    xmlhttp.open("POST", "GetSearch.do", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("category=" + category.value);
}

function editcats() {
    var xmlhttp;
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
        }
    }
    document.getElementById("myDiv").innerHTML = "<h3>Loading Categories...Please Wait...</h3><br><img src=\"theme/app/images/loader.gif\" alt=\"loading\">"
    xmlhttp.open("GET", "Categories.do", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send();
}

function gorlog(mdays) {
    document.getElementById("rdays").value = mdays;
    document.logrid.submit();
}


//
// Load Radio Log for "x" days
//
function loadrlog(days) {
    var xmlhttp;
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
        }
    }
    document.getElementById("myDiv").innerHTML = "<h3>Retrieving Radio Log...Please Wait...</h3><br><img src=\"theme/app/images/loader.gif\" alt=\"loading\">"
    var mystring = "(" + days + " days)";
    switch (days) {
        case .666:
            document.getElementById("numdays").innerHTML = "(16 hours)";
            break;
        case 1:
            document.getElementById("numdays").innerHTML = "(24 hours)";
            break;
        case 0:
            document.getElementById("numdays").innerHTML = "(All Entries)";
            break;
        default:
            document.getElementById("numdays").innerHTML = mystring;
    }
    xmlhttp.open("POST", "GetRadioLog.do", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("days=" + days);
}


//
// Admin Show User Password
//
function ShowPass(id) {
    var xmlhttp;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert(xmlhttp.responseText);
        }
    }

    xmlhttp.open("POST", "GetUserPass.do", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + id);
}

//
// Admin Reset User Password
//
function ResetPass(id) {
    var xmlhttp;
    xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            alert(xmlhttp.responseText);
        }
    }

    xmlhttp.open("POST", "ResetUserPass.do", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("id=" + id);
}