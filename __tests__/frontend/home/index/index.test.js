import React from 'react';
import ReactDOM from 'react-dom';
import OrderHandler from '../../../../resources/assets/frontend/js/home/index/Components/OrderHandler';

/* global trans */
const trans = translation => (translation);

it('renders without crashing', () => {
  const div = document.createElement('div');
  ReactDOM.render(<OrderHandler />, div);
});
