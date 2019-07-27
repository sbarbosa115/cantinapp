import React from 'react';
import { connect } from 'react-redux';
import Modal from 'react-bootstrap-modal';
import PropTypes from 'prop-types';
import moment from 'moment';
import { ConfigurationConsumer } from '../../Context/Configuration';


const OrderCreated = ({ orderCreated, onCloseHandler }) => (
  <ConfigurationConsumer>
    {({ imageSuccess }) => (
      <Modal
        show
        onHide={onCloseHandler}
      >
        <Modal.Header closeButton>
          <Modal.Title id="ModalHeader">
            { trans('frontend.homepage.order_created') }
          </Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <div className="form-row">
            <div className="form-group col-md-12 text-center">
              <h4>
                {`${trans('frontend.homepage.order_created_copy_a')}
                ${moment(orderCreated.order.pickup_at, 'YYYY-MM-DD HH:mm').fromNow()}
                ${trans('frontend.homepage.order_created_copy_b')}`}
              </h4>
              <img src={imageSuccess} alt="Cooking your order" className="img-responsive" />
            </div>
            <div className="clearfix" />
          </div>
        </Modal.Body>
      </Modal>
    )}
  </ConfigurationConsumer>
);

OrderCreated.propTypes = {
  orderCreated: PropTypes.shape({
    order: PropTypes.shape({
      pickup_at: PropTypes.string.isRequired,
    }),
  }).isRequired,
  onCloseHandler: PropTypes.func.isRequired,
};

export default connect()(OrderCreated);
