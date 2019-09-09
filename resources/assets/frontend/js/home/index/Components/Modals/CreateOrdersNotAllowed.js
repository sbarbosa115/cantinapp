import React from 'react';
import Modal from 'react-bootstrap-modal';
import { ConfigurationConsumer } from '../../Context/Configuration';

const CreateOrdersNotAllowed = () => (
  <ConfigurationConsumer>
    {({ imageError }) => (
      <Modal
        show
        onHide={() => {}}
      >
        <Modal.Header closeButton>
          <Modal.Title id="ModalHeader">
            { trans('frontend.homepage.orders_disabled_title') }
          </Modal.Title>
        </Modal.Header>
        <Modal.Body>
          <div className="form-row">
            <div className="form-group col-md-12 text-center">
              <h4>
                {trans('frontend.homepage.orders_disabled_content')}
              </h4>
              <img src={imageError} alt={trans('frontend.homepage.orders_disabled')} className="img-responsive" />
            </div>
            <div className="clearfix" />
          </div>
        </Modal.Body>
      </Modal>
    )}
  </ConfigurationConsumer>
);

export default CreateOrdersNotAllowed;
