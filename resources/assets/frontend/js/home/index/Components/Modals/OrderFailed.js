import React from 'react';
import Modal from 'react-bootstrap-modal';
import PropTypes from 'prop-types';
import { ConfigurationConsumer } from '../../Context/Configuration';

const OrderFailed = ({ onCloseHandler }) => (
  <ConfigurationConsumer>
    {({ imageError }) => (
      <Modal
        show
        onHide={onCloseHandler}
      >
        <Modal.Header closeButton>
          <Modal.Title id="ModalHeader">
            { trans('frontend.homepage.order_not_created') }
          </Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <div className="form-row">
            <div className="form-group col-md-12 text-center">
              <h4>
                {`${trans('frontend.homepage.order_not_created_copy')}`}
              </h4>
              <img src={imageError} alt="Error trying to create your order" className="img-responsive" />
            </div>
            <div className="clearfix" />
          </div>
        </Modal.Body>
      </Modal>
    )}
  </ConfigurationConsumer>
);

OrderFailed.propTypes = {
  onCloseHandler: PropTypes.func.isRequired,
};

export default OrderFailed;
