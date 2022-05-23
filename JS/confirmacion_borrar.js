function confirmación(e) {
    if(confirm("¿Seguro de eliminar el dato?")) {
        return true;
    }else {
        e.preventDefault();
    }
}

let LinkDelete = document.querySelectorAll("eliminar.php");

for (var i = 0; i<LinkDelete.length; i++) {
    LinkDelete[i].addEventListener('click', confirmación)
}