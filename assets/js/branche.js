function getBranche(){
    //alert(idClasse);
    var idBranche = "#branche";
    //alert(id);
    var branche = $(id).val();
    var brancheSection = "#brancheSection";
    var data = 'idBranche='+branche;
    $.ajax({
        type: "POST",
        url: "../ajax/branche.php",
        data: data,
        cache: false,
        success: function(html){
            $(brancheSection).html(html);
        }
    });
}