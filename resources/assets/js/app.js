(function() {

    // Subscribe to the form.submitted event. When event fires, show the flash
    // message by finding the .flash element and showing it for one second
    $.subscribe('form.submitted', function() {
        $('.flash').fadeIn(500).delay(1000).fadeOut(500);
    });

})();