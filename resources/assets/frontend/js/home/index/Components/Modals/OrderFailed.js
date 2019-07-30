import { connect } from 'react-redux';
import React from 'react';
import Modal from 'react-bootstrap-modal';
import PropTypes from 'prop-types';
import { ConfigurationConsumer } from '../../Context/Configuration';
import { SHOW_MODAL_ORDER_FAILED } from '../../Actions/modal';

const mapStateToProps = state => ({
  ...state,
});

const mapDispatchToProps = dispatch => ({
  toggleOrderFailedModal: flag => dispatch({
    type: SHOW_MODAL_ORDER_FAILED,
    orderFailed: flag,
  }),
});

const OrderFailed = ({ forceUpdate, toggleOrderFailedModal }) => (
  <ConfigurationConsumer>
    {({ imageError }) => (
      <Modal
        show
        onHide={() => {
          toggleOrderFailedModal(false);
          forceUpdate();
        }}
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
  forceUpdate: PropTypes.func,
  toggleOrderFailedModal: PropTypes.func,
};

OrderFailed.defaultProps = {
  forceUpdate: () => (''),
  toggleOrderFailedModal: () => (''),
};

export default connect(mapStateToProps, mapDispatchToProps)(OrderFailed);
