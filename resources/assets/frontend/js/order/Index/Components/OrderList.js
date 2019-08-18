import React, { useState } from 'react';
import PropTypes from 'prop-types';
import moment from 'moment';
import momentLocalizer from 'react-widgets-moment';
import ReOrder from './Modals/ReOrder';
import OrderProtoType from '../Model/Order';

moment.locale('en');
momentLocalizer();

const CREATED_ORDER = 'created';

const OrderList = ({ orders }) => {
  const [showReOrderModal, setShowReOrderModal] = useState(false);
  const [orderSelected, setOrderSelected] = useState({});
  return (
    <section className="order-layout">
      <div className="order-wrapper">
        <div className="container">
          <div className="row">
            <div className="order-inner">
              <div className="order-content">
                <div className="order-id">
                  <h2>{trans('frontend.orders.my_history')}</h2>
                </div>
                <div className="order-info">
                  <div className="order-info-inner">
                    <table id="order_details">
                      <thead>
                        <tr>
                          <th>{trans('frontend.orders.products')}</th>
                          <th>{trans('frontend.orders.date')}</th>
                          <th>{trans('frontend.orders.quantity')}</th>
                          <th>{trans('frontend.orders.status')}</th>
                        </tr>
                      </thead>
                      <tbody>
                        {orders.map((order, orderIndex) => (
                          <tr className={orderIndex % 2 === 0 ? 'odd' : 'even'} key={order.id}>
                            <td className="td-product">
                              {order.name}
                            </td>
                            <td className="sku note">
                              {order.created_date}
                            </td>
                            <td className="money text-center">
                              {order.total_products}
                            </td>
                            <td className="money">
                              {order.status.charAt(0).toUpperCase() + order.status.slice(1)}
                              {' '}
                              {order.status === CREATED_ORDER && (
                                <button
                                  type="button"
                                  className="btn btn-danger"
                                  onClick={() => {
                                    setShowReOrderModal(true);
                                    setOrderSelected(order);
                                  }}
                                >
                                  {trans('frontend.orders.re_order')}
                                </button>
                              )}
                            </td>
                          </tr>
                        ))}
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      {showReOrderModal && (
        <ReOrder
          closeReOrderModal={() => {
            setShowReOrderModal(false);
            setOrderSelected({});
          }}
          order={orderSelected}
        />
      )}
    </section>
  );
};

OrderList.propTypes = {
  orders: PropTypes.arrayOf(PropTypes.shape(OrderProtoType)),
};

OrderList.defaultProps = {
  orders: [],
};

export default OrderList;
