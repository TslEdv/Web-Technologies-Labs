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
    } else {
        var person = prompt("Please enter your name", "Peeter Peet");
        if (person != "" && person != null) {
            document.getElementById("demo").innerHTML = person + "'s Shopping List";
            document.cookie = "username=" + person;
            sessionStorage.setItem("username", person);
        }
    }
}
function delRow(e) {
    if (e.target.matches('.delete')) {
      let row = e.target.closest('tr');
      row.remove();
    }
  }
function addShopping() {
    var table = document.getElementById("shopping");
    var length = table.rows.length;
    var row = table.insertRow(length);
    row.setAttribute("onclick", "remove(length)");
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    cell1.innerHTML = length + ".";
    cell2.innerHTML = document.getElementById("itemname").value;
    cell3.innerHTML = document.getElementById("quantity").value;
    var product = '{"Product":' + '"' + document.getElementById("itemname").value +'", "Quantity":' + '"' + document.getElementById("quantity").value + '"}';
    var json = JSON.parse(product);
    localStorage.setItem("ItemNr"+length, JSON.stringify(json));
}
function remove(lenght){
    if(confirm("Are you sure you want to delete this item?")){
        document.getElementById("shopping").deleteRow(lenght+1);
    }
}
checkCookie();