//(function() {
//
//    // Submit form via AJAX. Function accepts the submit event and prevents
//    // its default behaviour. Instead it fires AJAX request
//    var submitAjaxRequest = function(e) {
//        e.preventDefault();
//
//        // form wrapped in a JQuery object
//        var form = $(this);
//
//        // find the hidden input field inside form that has a name _method and
//        // get its value since that field is used to fake the method to other
//        // than GET or POST. If the field doesn't exist default to POST
//        var method = form.find('input[name="_method"]').val() || 'POST';
//
//        $.ajax({
//            type: method,
//            //url is the action property of the form
//            url: form.prop('action'),
//            data: form.serialize(),
//            success: function() {
//                // publish form.submitted event and pass
//                // form in case it will be needed
//                $.publish('form.submitted', form);
//            }
//        })
//    };
//
//    // Find any element that has a custom attribute data-click-submits-form and on
//    // state change (ex. click) find the closest form and submit it
//    $('*[data-click-submits-form]').on('change', function() {
//        $(this).closest('form').submit();
//    })
//
//    // Find form with the data-remote custom attribute and when it gets submitted
//    // trigger submitAjaxRequest function which will prevent the default action
//    // of submitting the form and fire AJAX submit request
//    $('form[data-remote]').on('submit', submitAjaxRequest);
//
//})();