Vue.component('register', {
    props: {  },

    ready: function () {
        console.log('register component ready');
    },

    data: function () {
        return {
            formValid: true,
            formBusy: false,
        };
    },

    methods: {
        onSubmit: function onSubmit(e) {
            this.formValid = this.$validator.valid;

            if (this.formValid) {
                this.formBusy = true;
                e.target.submit();
            }
        }
    }
});
