$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function(){
	$('.sort-table').tablesorter();
    $('.birthday-picker').pickadate({
        selectMonths: true,
        selectYears: 100,
        format: 'dd mmmm yyyy',
        formatSubmit: 'yyyy-mm-dd',
        hiddenName: true
    });
    $('.datepicker').pickadate({
        selectMonths: true,
        selectYears: true,
        formatSubmit: 'yyyy-mm-dd',
        hiddenName: true
    });
    $('.timepicker').pickatime({
        selectMonths: true,
        selectYears: true,
        format: 'HH:i',
        formatSubmit: 'HH:i',
        hiddenName: true,
        interval: 15
    });

    $('.btn-danger, .btn-confirm').click( function() {
        return confirm('Zeker weten?');
    });

    $('[data-toggle="offcanvas"]').click(function () {
        $('.row-offcanvas').toggleClass('active')
    });

    $('#hamburger-icon').click(function(){
        $(this).toggleClass('open');
    });
});