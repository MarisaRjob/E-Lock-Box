jQuery(function($){
    $('input[data-type=date]').each(function(i, e){
        if (!$(e).data('date-format'))
        {
            $(e).attr('data-date-format', 'YYYY-MM-DD').data('date-format', 'YYYY-MM-DD');
        }

        var format = $(e).attr('data-date-format');

        if ($(e).val() == '0000-00-00')
        {
            $(e).val('');
        }
        $(e).wrap($('<div class="input-group date"/>').data('date-format', format)).parent().append('<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>').datetimepicker({
            pickTime: false
        });
    });
    $('input[data-type=datetime]').each(function(i, e){
        if (!$(e).data('date-format'))
        {
            $(e).attr('data-date-format', 'YYYY-MM-DD HH:mm:ss').data('date-format', 'YYYY-MM-DD HH:mm:ss');
        }

        var format = $(e).attr('data-date-format');

        if ($(e).val() == '0000-00-00 00:00:00')
        {
            $(e).val('');
        }
        $(e).wrap($('<div class="input-group date"/>').data('date-format', format)).parent().append('<span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>').datetimepicker({
            pickTime: true
        });
    });

});