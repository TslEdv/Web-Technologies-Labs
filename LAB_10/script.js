function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
function checkCookie() {
    var person = getCookie("username");
    if (person != "") {
        document.getElementById("title").innerHTML = person + "'s Shopping List";
        var x = localStorage.length;
        if (x != 0) {
            for (var i = 0; i < x; i++) {
                var table = document.getElementById("shopping");
                var length = table.rows.length;
                if(localStorage[getCookie("username")+length] != null){
                    var y = JSON.parse(localStorage[getCookie("username")+length]);
                } else{
                    var y = JSON.parse(localStorage[getCookie("username")+(length+1)]);
                    i++;
                }
                var row = table.insertRow(length);
                row.setAttribute("onclick", "remove(" + length + ")");
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                cell1.innerHTML = length + ".";
                cell2.innerHTML = y.Product;
                cell3.innerHTML = y.Quantity;
            }
        }
    } else {
        var person = prompt("Please enter your name", "Peeter Peet");
        if (person != "" && person != null) {
            document.getElementById("title").innerHTML = person + "'s Shopping List";
            document.cookie = "username=" + person;
            sessionStorage.setItem("username", person);
            var x = localStorage.length;
            if (x != 0) {
                for (var i = 0; i < x; i++) {
                    var table = document.getElementById("shopping");
                    var length = table.rows.length;
                    var y = JSON.parse(localStorage[getCookie("username")+length]);
                    var row = table.insertRow(length);
                    row.setAttribute("onclick", "remove(" + length + ")");
                    var cell1 = row.insertCell(0);
                    var cell2 = row.insertCell(1);
                    var cell3 = row.insertCell(2);
                    cell1.innerHTML = length + ".";
                    cell2.innerHTML = y.Product;
                    cell3.innerHTML = y.Quantity;
                }
            }
        }
    }
}
function addShopping() {
    var table = document.getElementById("shopping");
    var length = table.rows.length;
    var row = table.insertRow(length);
    row.setAttribute("onclick", "remove(" + length + ")");
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = length + ".";
    cell2.innerHTML = document.getElementById("itemname").value;
    cell3.innerHTML = document.getElementById("quantity").value;
    var product = '{"Product":' + '"' + document.getElementById("itemname").value + '", "Quantity":' + '"' + document.getElementById("quantity").value + '"}';
    var json = JSON.parse(product);
    localStorage.setItem(getCookie("username")+length, JSON.stringify(json));
    location.reload();
}
function remove(lenght) {
    if (confirm("Are you sure you want to delete this item?")) {
        document.getElementById("shopping").deleteRow(lenght);
        localStorage.removeItem(getCookie("username")+lenght);
        var x = localStorage.length;
        if (x != 0) {
            for (var i = 1; i < x+1; i++) {
                if(localStorage[getCookie("username")+i] == null){
                    if(localStorage[getCookie("username")+(i+1)] != null){
                        localStorage[getCookie("username")+i] = localStorage[getCookie("username")+(i+1)];
                        delete localStorage[getCookie("username")+(i+1)];
                    }
                }
            }
        }
        location.reload();
    }
}
function logout(){
    document.cookie = "username=Monkey; expires=Thu, 01 Jan 1970 00:00:00 UTC;";
    location.reload();
}
checkCookie();
