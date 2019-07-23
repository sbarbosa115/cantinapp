import React from 'react';
import Modal from 'react-bootstrap-modal';
import PropTypes from 'prop-types';
import moment from 'moment';
import { connect } from 'react-redux';
import DateTimePicker from 'react-widgets/lib/DateTimePicker';
import { createEmptyProducts, setPickUpTime } from '../Actions/order';
import roundedUp from '../../Utils/DateUtils';
import OrderProduct from './Tabs/OrderProduct';
import Product from '../Model/Product';

const AddProductModal = ({
  closeHandler, store, forceUpdate,
}) => (
  <Modal
    show
    onHide={closeHandler}
  >
    <Modal.Header closeButton>
      <Modal.Title id="ModalHeader">
        { trans('frontend.homepage.add_products_to_order') }
      </Modal.Title>
    </Modal.Header>
    <Modal.Body>
      <div className="form-row">
        <div className="form-group col-md-6">
          { trans('frontend.homepage.pickup_time') }
          <DateTimePicker
            min={moment().minute(roundedUp).second(0).toDate()}
            date={false}
            step={15}
            onChange={value => store.dispatch(setPickUpTime(value))}
            defaultValue={store.getState().order.pickup_at}
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
                store.dispatch(createEmptyProducts(products));
                forceUpdate();
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
          <OrderProduct store={store} forceUpdate={forceUpdate} />
        </div>
      </div>
      <div className="clearfix" />
    </Modal.Body>
  </Modal>
);

AddProductModal.propTypes = {
  store: PropTypes.shape({}).isRequired,
  closeHandler: PropTypes.func.isRequired,
  forceUpdate: PropTypes.func.isRequired,
};


export default connect()(AddProductModal);
