//
// browserify entry point
//

/*
 * Load Vue, Vue-Resource & Vue-Validator.
 */
if (window.Vue === undefined) {
    window.Vue = require('vue');
}

require('vue-resource');
require('vue-validator');

Vue.config.debug = true;

//components
require('./components/register');
require('./components/login');

new Vue({
    el: '#app',

    components: { },

    ready: function() {
        console.log('Vue Ready');
    }
});
