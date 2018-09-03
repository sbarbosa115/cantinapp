import ReactDOM from 'react-dom';
import React from 'react';
import Order from './Order';
import Search from "./Search";

if(document.getElementById('index-products')){
    ReactDOM.render(<Search />, document.getElementById('index-products'));
}

if(document.getElementById('order-component')){
    const container = document.getElementById('order-component');
    const customer = JSON.parse(container.dataset.customer);
    const order = JSON.parse(container.dataset.order);
    ReactDOM.render(<Order customer={customer} order={order}/>, container);
}
