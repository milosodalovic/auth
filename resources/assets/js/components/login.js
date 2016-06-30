Vue.component('login', {
    props: {  },

    ready: function () {
        console.log('login component ready');
    },

    data: function () {
        return {
            email: '',
            password: '',
            formValid: true,
            formBusy: false,
        };
    },

    methods: {
        onSubmit: function onSubmit(e) {
            this.formValid = this.email != '' && this.password != '';

            if (this.formValid) {
                this.formBusy = true;
                e.target.submit();
            }
        }
    }
});
