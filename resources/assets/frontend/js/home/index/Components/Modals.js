import React from 'react';
import Modal from 'react-bootstrap-modal';
import PropTypes from 'prop-types';
import moment from 'moment';
import DateTimePicker from 'react-widgets/lib/DateTimePicker';
import roundedUp from '../../Utils/DateUtils';

export const AddProductModal = ({ product }) => (
  <Modal
    show
  >
    <Modal.Header closeButton>
      <Modal.Title id="ModalHeader">
        { trans('frontend.homepage.add_products_to_order') }
      </Modal.Title>
    </Modal.Header>
    <Modal.Body>
      <div className="form-row">
        <div className="form-group col-md-8">
          <label htmlFor="dish">
            { trans('frontend.homepage.dish') }
            <input type="text" className="form-control" value={product.name} readOnly />
          </label>
        </div>
        <div className="form-group col-md-4">
          {/* eslint-disable-next-line jsx-a11y/label-has-for */}
          <label htmlFor="dishesNumber">
            { trans('frontend.homepage.quantity') }
            <select id="dishesNumber" className="form-control">
              <option value="1">{`1 ${trans('frontend.homepage.dish')}`}</option>
              <option value="2">{`2 ${trans('frontend.homepage.dishes')}`}</option>
              <option value="3">{`3 ${trans('frontend.homepage.dishes')}`}</option>
            </select>
          </label>
        </div>
        <div className="form-group col-md-12">
          { trans('frontend.homepage.pickup_time') }
          <DateTimePicker
            min={moment().minute(roundedUp).second(0).toDate()}
            date={false}
            step={15}
            //onChange={value => this.setState({ pickUpDate: value })}
          />
        </div>
      </div>
      <div className="clearfix" />
    </Modal.Body>
  </Modal>
);

AddProductModal.propTypes = {
  product: PropTypes.shape({}).isRequired,
};

export const NotProductFoundModal = () => (
  <Modal
    show
    onHide={() => console.log('on close')}
  >
    <Modal.Header closeButton>
      <Modal.Title id="ModalHeader">
        { trans('frontend.homepage.add_products_to_order') }
      </Modal.Title>
    </Modal.Header>
    <Modal.Body>
      <h1>TEMP</h1>
    </Modal.Body>
  </Modal>
);

NotProductFoundModal.propTypes = {
  product: PropTypes.shape({}).isRequired,
};
