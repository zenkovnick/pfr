$(function() {
    $('.dashboard-filters').css('visibility', 'hidden');
});
$(window).load(function() {
    
    $('#flight_filter_plane').selectmenu();
    $('#flight_filter_pilot').selectmenu();
    $('#flight_filter_date').selectmenu();
    $('#flight_filter_sort').selectmenu();
    
    $('.dashboard-filters').removeAttr('style');
});
