function deleteElement(idElement, elementSource){
    var data = 'idElement='+idElement+'elementSource='+elementSource;
    $.ajax({
        type: "POST",
        url: "../ajax/delete-element.php",
        data: data,
        cache: false
    });
}