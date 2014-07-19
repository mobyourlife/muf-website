$('#radioBtn a').on('click', function()
{
    var sel = $(this).data('title');
    var tog = $(this).data('toggle');
    $('#'+tog).prop('value', sel);
    
    $('a[data-toggle="'+tog+'"]').not('[data-title="'+sel+'"]').removeClass('btn-primary').addClass('btn-default');
    $('a[data-toggle="'+tog+'"][data-title="'+sel+'"]').removeClass('btn-default').addClass('btn-primary');
})