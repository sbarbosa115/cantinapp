import React from 'react';
import Modal from 'react-bootstrap-modal';
import PropTypes from 'prop-types';

const MoreInfoProduct = ({ closeHandler, product }) => (
  <Modal
    show
    onHide={() => {
      closeHandler(false);
    }}
  >
    <Modal.Header closeButton>
      <Modal.Title id="ModalHeader">
        {product.name}
      </Modal.Title>
    </Modal.Header>
    <Modal.Body>
      <div className="card-title">
        <img src={product.image_path} alt={product.name} className="img-responsive"/>
      </div>
      <br />
      <div className="card-body">
        <p>
          {product.description}
        </p>
      </div>
      <div className="clearfix" />
    </Modal.Body>
    <Modal.Footer>
      <button
        type="button"
        className="btn btn-success"
        onClick={() => {
          closeHandler(false);
        }}
      >
        {trans('frontend.close')}
      </button>
    </Modal.Footer>
  </Modal>
);

MoreInfoProduct.propTypes = {
  product: PropTypes.shape({
    name: PropTypes.string.isRequired,
    image_path: PropTypes.string.isRequired,
    description: PropTypes.string.isRequired,
  }).isRequired,
  closeHandler: PropTypes.func,
};


MoreInfoProduct.defaultProps = {
  closeHandler: () => {},
};

export default MoreInfoProduct;
