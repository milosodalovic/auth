Vue.component('register', {
    props: {  },

    ready: function () {
        console.log('register component ready');
    },

    data: function () {
        return {
            formBusy: false,
        };
    },

    methods: {
        onSubmit: function onSubmit(e) {
            var formValid = $('form[data-parsley-validate]').parsley().validate();

            if(formValid){
                this.formBusy = true;
                e.target.submit();
            }
        }
    }
});
