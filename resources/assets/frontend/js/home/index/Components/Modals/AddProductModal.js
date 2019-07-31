import React, { useState } from 'react';
import Modal from 'react-bootstrap-modal';
import PropTypes from 'prop-types';
import moment from 'moment';
import { connect } from 'react-redux';
import DateTimePicker from 'react-widgets/lib/DateTimePicker';
import { CREATE_EMPTY_PRODUCTS, RESET_ORDER_STATE, SET_PICK_UP_TIME } from '../../Actions/order';
import roundedUp from '../../../Utils/DateUtils';
import OrderProduct from '../Tabs/OrderProduct';
import Product from '../../Model/Product';
import { ConfigurationConsumer } from '../../Context/Configuration';
import {
  SHOW_MODAL_CREATE_ORDER,
  SHOW_MODAL_ORDER_ADDED,
  SHOW_MODAL_ORDER_FAILED,
  SHOW_MODAL_ORDER_FORBIDDEN,
} from '../../Actions/modal';

const isOrderValid = ({ order, sidesNumber, beveragesNumber }) => (
  !((order.products
    .some(product => (
      product.sides.length !== sidesNumber
      || product.beverages.length !== beveragesNumber
    )) || order.pickup_at === null))
);

const mapStateToProps = state => ({
  ...state,
});

const mapDispatchToProps = dispatch => ({
  setPickUpTime: time => (
    dispatch({
      type: SET_PICK_UP_TIME,
      pickUpTime: time,
    })
  ),
  createEmptyProducts: products => dispatch({
    type: CREATE_EMPTY_PRODUCTS,
    products,
  }),
  toggleOrderCreatedModal: (flag = false, orderCreated) => dispatch({
    type: SHOW_MODAL_ORDER_ADDED,
    orderCreated: flag,
    orderCreatedData: orderCreated,
  }),
  toggleOrderFailedModal: (flag = false) => dispatch({
    type: SHOW_MODAL_ORDER_FAILED,
    orderFailed: flag,
  }),
  toggleOrderForbiddenModal: (flag = false) => dispatch({
    type: SHOW_MODAL_ORDER_FORBIDDEN,
    orderForbidden: flag,
  }),
  toggleCreateOrderModal: (flag = false) => dispatch({
    type: SHOW_MODAL_CREATE_ORDER,
    createOrder: flag,
  }),
  resetOrderState: () => dispatch({
    type: RESET_ORDER_STATE,
  }),
});

const AddProductModal = ({
  order, setPickUpTime, createEmptyProducts, toggleOrderFailedModal, toggleOrderCreatedModal,
  toggleCreateOrderModal, toggleOrderForbiddenModal, resetOrderState, forceUpdate,
}) => {
  const [errors, setErrors] = useState({});
  return (
    <ConfigurationConsumer>
      {({ sidesNumber, beveragesNumber, pathCreateOrder }) => (
        <Modal
          show
          onHide={() => {
            toggleCreateOrderModal(false);
            resetOrderState();
            forceUpdate();
          }}
        >
          <Modal.Header closeButton>
            <Modal.Title id="ModalHeader">
              { trans('frontend.homepage.add_products_to_order') }
            </Modal.Title>
          </Modal.Header>
          <Modal.Body>
            <form>
              <div className="form-row">
                {Object.keys(errors).length > 0 && (
                  <div className="alert alert-danger animated flash">
                    { trans('frontend.homepage.form_errors.label') }
                    <ul className="text-left">
                      {Object.keys(errors).map(error => (
                        <li>{errors[error]}</li>
                      ))}
                    </ul>
                  </div>
                )}

                <div className="form-group col-md-6">
                  {!order.pickup_at && <i className="fa fa-arrow-right animated rotateIn" aria-hidden="true" />}
                  { trans('frontend.homepage.pickup_time') }
                  <DateTimePicker
                    min={moment().minute(roundedUp).second(0).toDate()}
                    date={false}
                    step={15}
                    onChange={(value) => {
                      setPickUpTime(moment(value).format('HH:mm'));
                    }}
                    defaultValue={order.pickup_at}
                  />
                </div>
                <div className="form-group col-md-6">
                  {/* eslint-disable-next-line jsx-a11y/label-has-for */}
                  <label htmlFor="dishesNumber">
                    { trans('frontend.homepage.quantity') }
                    <select
                      id="dishesNumber"
                      className="form-control"
                      onChange={(e) => {
                        const products = Array(Number(e.target.value))
                          .fill(null)
                          .map(() => (new Product()));
                        createEmptyProducts(products);
                      }}
                    >
                      <option value="1">
                        {`1 ${trans('frontend.homepage.dish')}`}
                      </option>
                      <option value="2">
                        {`2 ${trans('frontend.homepage.dishes')}`}
                      </option>
                      <option value="3">
                        {`3 ${trans('frontend.homepage.dishes')}`}
                      </option>
                    </select>
                  </label>
                </div>
                <div className="form-group col-md-12">
                  <OrderProduct />
                </div>
                <div className="form-group">
                  <button
                    type="button"
                    className="btn btn-success btn-lg btn-block"
                    onClick={() => {
                      if (
                        isOrderValid({ order, sidesNumber, beveragesNumber })
                      ) {
                        const token = window.document.head.querySelector('meta[name="csrf-token"]');
                        fetch(pathCreateOrder, {
                          headers: {
                            'Content-Type': 'application/json',
                            Accept: 'application/json',
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-Token': token.content,
                          },
                          method: 'post',
                          body: JSON.stringify(order),
                        }).then(response => response.json())
                          .then((response) => {
                            if (response.status === 'ok') {
                              toggleCreateOrderModal(false);
                              toggleOrderCreatedModal(true, response.order);
                              resetOrderState();
                              forceUpdate();
                            } else if (response.status === 'Forbidden') {
                              toggleCreateOrderModal(false);
                              toggleOrderForbiddenModal(true);
                              forceUpdate();
                            } else if (response.message) {
                              setErrors(response.errors);
                            } else {
                              toggleCreateOrderModal(false);
                              toggleOrderFailedModal(true);
                              forceUpdate();
                            }
                          });
                      }
                    }}
                    disabled={
                      !isOrderValid({ order, sidesNumber, beveragesNumber })
                    }
                  >
                    {trans('frontend.homepage.create_order')}
                  </button>
                </div>
              </div>
            </form>
            <div className="clearfix" />
          </Modal.Body>
        </Modal>
      )}
    </ConfigurationConsumer>
  )
};

AddProductModal.propTypes = {
  order: PropTypes.shape({
    pickup_at: PropTypes.string,
  }),
  setPickUpTime: PropTypes.func,
  createEmptyProducts: PropTypes.func,
  forceUpdate: PropTypes.func,
  toggleOrderCreatedModal: PropTypes.func,
  toggleOrderFailedModal: PropTypes.func,
  toggleCreateOrderModal: PropTypes.func,
  toggleOrderForbiddenModal: PropTypes.func,
  resetOrderState: PropTypes.func,
};


AddProductModal.defaultProps = {
  order: {
    pickup_at: null,
  },
  setPickUpTime: () => (''),
  forceUpdate: () => (''),
  createEmptyProducts: () => (''),
  toggleOrderCreatedModal: () => (''),
  toggleOrderFailedModal: () => (''),
  toggleCreateOrderModal: () => (''),
  toggleOrderForbiddenModal: () => (''),
  resetOrderState: () => (''),
};

export default connect(mapStateToProps, mapDispatchToProps)(AddProductModal);
