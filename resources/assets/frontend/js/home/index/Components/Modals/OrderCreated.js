import React from 'react';
import { connect } from 'react-redux';
import Modal from 'react-bootstrap-modal';
import PropTypes from 'prop-types';
import moment from 'moment';
import { ConfigurationConsumer } from '../../Context/Configuration';
import { RESET_MODAL_STATE, SHOW_MODAL_ORDER_ADDED } from '../../Actions/modal';

const mapDispatchToProps = dispatch => ({
  toggleOrderCreatedModal: (flag = false, orderCreated) => dispatch({
    type: SHOW_MODAL_ORDER_ADDED,
    orderCreated: flag,
    orderCreatedData: orderCreated,
  }),
  resetOrderState: () => dispatch({
    type: RESET_MODAL_STATE,
  }),
});

const mapStateToProps = state => ({
  ...state,
  orderCreatedData: state.modals.orderCreatedData,
});

const OrderCreated = ({
  orderCreatedData, forceUpdate, toggleOrderCreatedModal, resetOrderState,
}) => (
  <ConfigurationConsumer>
    {({ imageSuccess }) => (
      <Modal
        show
        onHide={() => {
          toggleOrderCreatedModal(false);
          resetOrderState();
          forceUpdate();
        }}
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
                ${moment(orderCreatedData.pickup_at, 'YYYY-MM-DD HH:mm').fromNow()}
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
  forceUpdate: PropTypes.func,
  toggleOrderCreatedModal: PropTypes.func,
  resetOrderState: PropTypes.func,
  orderCreatedData: PropTypes.shape({
    pickup_at: PropTypes.string,
  }),
};

OrderCreated.defaultProps = {
  orderCreatedData: {
    order: {
      pickup_at: null,
    },
  },
  forceUpdate: () => (''),
  toggleOrderCreatedModal: () => (''),
  resetOrderState: () => (''),
};

export default connect(mapStateToProps, mapDispatchToProps)(OrderCreated);
