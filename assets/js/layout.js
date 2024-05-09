function loadPage(page, id, id_cate) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("app").innerHTML = this.responseText;
            window.location.href = "#detail-pro";
        }
    };
    if (id && id_cate){
        xhttp.open("GET", "pages/" + page + ".php?id=" + id + "&id_category=" + id_cate, true);
    }else{
        xhttp.open("GET", "pages/" + page + ".php", true);
    }
    xhttp.send();
}