import ReactDOM from 'react-dom';
import React from 'react';
import Search from './index/Search';

/* global document */
const container = document.getElementById('index-products');
const categories = JSON.parse(container.dataset.categories);
const sides = JSON.parse(container.dataset.sides);
ReactDOM.render(<Search categories={categories} sides={sides} />, container);
