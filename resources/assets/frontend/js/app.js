import _ from 'lodash';

window.$ = window.jQuery = require('jquery');
window.trans = string => _.get(window.i18n, string);

require('hammerjs');
require('bootstrap3/dist/js/bootstrap.min');
require('./lib/classie');
require('./lib/application-appear');
require('./lib/jquery.themepunch.plugins');
require('./lib/jquery.themepunch.revolution.min');
require('./lib/cs.script');
require('../images/header.jpg');
require('../images/logo.svg');
require('../images/cooking.jpg');
require('../images/error.png');
