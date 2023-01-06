// Lodash
window._ = require('lodash')

// jQuery
window.$ = window.jQuery = require('jquery')

require('jquery-repeater-form')

// Select2
import 'select2';

// jQuery extra functions
require('./utilities/jquery-functions')

// Datatables
const dataTables = require('datatables.net-dt')
require('datatables.net-select')
require('datatables.net-buttons')
require('datatables.net-plugins/api/sum()')
require('./vendor/datatables/input')

// Import Alpine JS
import 'alpine-magic-helpers'
import 'alpinejs'

// import tw elements
import 'tw-elements';

// Datetimepicker
const flatpickr = require("flatpickr");
const feather = require("feather-icons");

//ether
const Web3 = require("web3")

//chart.js
const Chart = require("chart.js");

$.extend($.fn.dataTable.defaults, {
    'pageLength': 25,
    'pagingType': 'listbox',
    scrollX: true,
    autoWidth: false,
    lengthMenu: [
        [10, 25, 50, 100],
        ['10 results', '25 results', '50 results', '100 results']
    ],
    'language': {
        'lengthMenu': '_MENU_',
        searchPlaceholder: 'Search records',
        'search': '_INPUT_',
    }
});
// // $.fn.dataTable.ext.classes.sFilterInput = 'form-control md:w-64 text-sm mb-2';
// // $.fn.dataTable.ext.classes.sLengthSelect = 'form-select md:w-auto text-sm mb-2';
// $.fn.dataTable.ext.classes.sFilterInput = '';
// $.fn.dataTable.ext.classes.sLengthSelect = '';

// Axios
window.axios = require('axios')

// Axios -> Set Axios CSRF Token within Axios requests
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
const token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}

// Helper functions
window.helpers = require('./utilities/helpers')

// Layout files
require('./layout')

// Component files
require('./components')

// Page specific files
require('./pages')

require('./web3')

window.App = {
    token: token.content,
}

feather.replace();
