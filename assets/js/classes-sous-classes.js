$('#codeClasse').change(function(){
    var codeClasse = $(this).val();
    var data = 'codeClasse='+codeClasse;
    $.ajax({
        type: "POST",
        url: "../ajax/classes-sous-classes.php",
        data: data,
        cache: false,
        success: function(html){
            $('#codeSousClasse').html(html);
        }
    });
});