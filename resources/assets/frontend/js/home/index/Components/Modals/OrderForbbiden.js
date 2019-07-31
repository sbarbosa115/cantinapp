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
  toggleOrderForbiddenModal: flag => dispatch({
    type: SHOW_MODAL_ORDER_FAILED,
    orderForbidden: flag,
  }),
});

const OrderForbidden = ({ forceUpdate, toggleOrderForbiddenModal }) => (
  <ConfigurationConsumer>
    {({ imageError }) => (
      <Modal
        show
        onHide={() => {
          toggleOrderForbiddenModal(false);
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
                {trans('frontend.homepage.order_not_forbidden_copy')}
              </h4>
              <img src={imageError} alt={trans('frontend.homepage.order_not_forbidden_copy')} className="img-responsive" />
            </div>
            <div className="clearfix" />
          </div>
        </Modal.Body>
      </Modal>
    )}
  </ConfigurationConsumer>
);

OrderForbidden.propTypes = {
  forceUpdate: PropTypes.func,
  toggleOrderForbiddenModal: PropTypes.func,
};

OrderForbidden.defaultProps = {
  forceUpdate: () => (''),
  toggleOrderForbiddenModal: () => (''),
};

export default connect(mapStateToProps, mapDispatchToProps)(OrderForbidden);
