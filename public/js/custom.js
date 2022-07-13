$(window).on('beforeunload', function(){
    
    $('#pageLoader').show();

});

$(function () {

    $('#pageLoader').hide();
})