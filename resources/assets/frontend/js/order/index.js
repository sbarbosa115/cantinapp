import ReactDOM from 'react-dom';
import React from 'react';
import PropTypes from 'prop-types';
import OrderList from './Index/Components/OrderList';

const container = document.getElementById('order-list');
const {
  orders, allowOrders
} = container.dataset;

ReactDOM.render(
  <OrderList
    orders={JSON.parse(orders)}
    allowOrders={allowOrders === '1'}
  />, container,
);

OrderList.propTypes = {
  orders: PropTypes.string,
};

OrderList.defaultProps = {
  orders: [],
};
