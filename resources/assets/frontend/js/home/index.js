import ReactDOM from 'react-dom';
import React from 'react';
import Search from './index/Search';

/* global document */
const container = document.getElementById('index-products');
const categories = JSON.parse(container.dataset.categories);
const sides = JSON.parse(container.dataset.sides);
const signedId = JSON.parse(container.dataset.signedIn);
ReactDOM.render(<Search
  signedIn={signedId}
  categories={categories}
  sides={sides}
/>, container);
