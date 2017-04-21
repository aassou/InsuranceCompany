function getBranche(idBranche){
    alert(idBranche);
    var id             = "#branche"+idBranche;
    alert(id);
    var branche        = $(id).val();
    var brancheSection = "#brancheSection";
    var data = 'branche='+branche;
    $.ajax({
        type: "POST",
        url: "../ajax/branches.php",
        data: data,
        cache: false,
        success: function(html){
            $(brancheSection).html(html);
        }
    });
}