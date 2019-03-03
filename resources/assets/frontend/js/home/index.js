import ReactDOM from 'react-dom';
import React from 'react';
import Search from './index/Search';

/* global document */
const container = document.getElementById('index-products');
const categories = JSON.parse(container.dataset.categories);
ReactDOM.render(<Search categories={categories} />, container);
