(function () {

    // Find all input elements with the specified data-parsley arguments and if its
    // value is not valid on blur event mark it as invalid (validate it manually)
    $('input[data-parsley-required], input[data-parsley-maxlength], input[data-parsley-equalto], input[data-parsley-type="email"], input[data-parsley-pattern], input[data-parsley-type="password"]').on('blur', function() {
        var inputParsley = $(this).parsley();
        if( ! inputParsley.isValid()){
            inputParsley.validate();
        }
    });

})();