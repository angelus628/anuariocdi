$('#home').on('click', function(e){
    e.preventDefault();
    $.get('pages/home.php', function(data){
        $('#content-variable').html(data);
    });
});

$('#editorial').on('click', function(e){
    e.preventDefault();
    $.get('pages/editorial.php', function(data){
        $('#content-variable').html(data);
    });
});

$('#observatory').on('click', function(e){
    e.preventDefault();
    $.get('pages/observatory.php', function(data){
        $('#content-variable').html(data);
    });
});
