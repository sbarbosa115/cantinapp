import _ from 'lodash';

window.$ = window.jQuery = require('jquery');

require('hammerjs');
require('bootstrap3/dist/js/bootstrap.min');
require('./lib/classie');
require('./lib/application-appear');
require('./lib/jquery.themepunch.plugins');
require('./lib/jquery.themepunch.revolution.min');
require('./lib/cs.script');

window.axios = require('axios');

window.trans = string => _.get(window.i18n, string);
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const token = window.document.head.querySelector('meta[name="csrf-token"]');
if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

require('../images/header.jpg');
require('../images/logo.svg');
require('../images/cooking.jpg');
require('../images/error.png');
