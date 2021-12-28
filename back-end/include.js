function show(type, id) {
  if (id == "") {
    document.getElementById(type + "_viewer").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById(type + "_viewer").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET","/php/" + type + "_info.php?q=" + id,true);
    xmlhttp.send();
  }
}