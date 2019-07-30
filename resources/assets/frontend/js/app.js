import _ from 'lodash';

window.$ = window.jQuery = require('jquery');
window.trans = string => _.get(window.i18n, string);

require('bootstrap3/dist/js/bootstrap.min');
require('../images/header.jpg');
require('../images/logo.svg');
require('../images/cooking.jpg');
require('../images/error.png');
