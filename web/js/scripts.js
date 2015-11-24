$("[aria-label=View]").click(function(e) {

    $(".modal .modal-body").html('Загрузка...');

    $.get($(this).attr('href'), function(html){
        $(".modal .modal-body").html(html);
    });

    $("#myModal").modal('show');

    return false;
});