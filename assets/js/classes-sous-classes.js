function getSousClasse(idClasse){
    //alert(idClasse);
    var id = "#codeClasse"+idClasse;
    //alert(id);
    var codeClasse = $(id).val();
    var idSousClasse = "#codeSousClasse"+idClasse;
    var data = 'classe='+codeClasse;
    $.ajax({
        type: "POST",
        url: "../ajax/classes-sous-classes.php",
        data: data,
        cache: false,
        success: function(html){
            $(idSousClasse).html(html);
        }
    });
}