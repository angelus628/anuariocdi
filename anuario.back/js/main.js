var _window   = window;
var _try      = 1;
var mainFrame = window.parent.frames['mainFrame'];

$(document).ready(function(){
    /* Consulta las organizaciones existentes en la base de datos */
    $('#observ-form').ready(function(){
        $.ajax({
            method:   'post',
            url:      'lib/search.php',
            data:     {'organizations': true},
            dataType: 'json',
            success: function(data){
                var organizations = $('#observ-form').find('select#Organismo');
                organizations.html('<option disabled selected value> -- Seleccione una opción -- </option>');

                $.each(data, function(index, organization){
                    var option = $('<option data-value="' + index + '"></option>').text(organization).val(organization);
                    organizations.append(option);
                });
            },
        }).done(function(data){
            console.log('Query terminanted.');
        });
    });

    /* Cuando se selecciona una organizacion se buscan los anios disponibles en la base de datos */
    $('select#Organismo').on('change', function(e){
        console.log($('option:selected', this).val());
        $.ajax({
            method:   'post',
            data:     { organization: $('option:selected', this).val() },
            url:      'lib/search.php',
            dataType: 'json',
            success: function(data){
                var anios = $('select#anio');
                anios.html('<option disabled selected value> -- Seleccione una opción -- </option>');
                $.each(data, function(index, year){
                    var option = $('<option></option>').text(year).val(year);
                    anios.append(option);
                });
            },
        }).done(function(data){
            console.log('Query terminated.');
        });
    });

    /* Busqueda en la página */
    $('#search-form').on('submit', function(e){
        _window.find($(this).find('#search').val());
        return false;
    });

    /* Busqueda general en la base de datos en todas las tablas */
    $('#general-search').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            method: $(this).attr('method'),
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data){
                console.log(data);
                mainFrame.location.href = 'lib/' + data;
            },
        })
        .done(function(data) {
            console.log('Query terminated.');
        });
    });

    /* Busqueda de los observatorios por nombre y anio */
    $('#observ-form').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            method:    $(this).attr('method'),
            url:       $(this).attr('action'),
            data:      $(this).serialize(),
            success: function(data){
                console.log(data);
                mainFrame.location.href = 'lib/' + data;
            },
        })
        .done(function(data) {
            console.log('Query terminated.');
        });
    });

    /* Busqueda de los observatorios por nombre y anio */
    $('a.page-find-results').on('click', function(e){
        e.preventDefault();
        var url = $(this).data('url');
        console.log(url);
        mainFrame.location.href = url;
    });

    /* Carga los anios correspondientes cada organismo */
    $('#observatory-modal').on('show.bs.modal', function (event) {
        var area         = $(event.relatedTarget); // Button that triggered the modal
        var organization = area.data('organization'); // Extract info from data-* attributes
        var modal        = $(this);
        var body         = modal.find('.modal-body').html('');
        modal.find('.modal-title').text(organization);
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        $.ajax({
            method: 'post',
            url:    'lib/search.php',
            data:   { organization: organization },
            dataType: 'json',
            success: function(data){
                $.each(data, function(id, anio){
                    var paragraph = $('<p></p>').html(`<a class="organization-anio"
                    data-anio="` + anio + `" data-organization="` + organization + `"
                    href="javascript:void(0);">` + anio + `</a>`);
                    body.append(paragraph);
                });
            },
        }).done(function(data){
            console.log('Query Terminated.');
        });
    });

    $('body', mainFrame.document).on('click', 'a.organization-anio', function(e){
        e.preventDefault();
        $.ajax({
            method: 'post',
            url:    'lib/search.php',
            data:   {
                Organismo: $(this).data('organization'),
                anio: $(this).data('anio'),
            },
            success: function(url){
                console.log(url);
                mainFrame.location.href = 'lib/' + url;
            }
        }).done(function(data){
            console.log('Query Terminated.');
        });
    });
});
