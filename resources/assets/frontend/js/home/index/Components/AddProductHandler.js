import React, { Component } from 'react';
import PropTypes from 'prop-types';
import _ from 'lodash';
import 'react-tabs/style/react-tabs.css';
import 'animate.css';
import Modal from 'react-bootstrap-modal';

class AddProductHandler extends Component {
  constructor(props) {
    super(props);

    this.state = {
      product: props.product,
      productSelected: null,
    };

    this.handleCloseAddProductModal = this.handleCloseAddProductModal.bind(this);
    this.syncSelectedProductSides = this.syncSelectedProductSides.bind(this);
  }

  getSideById(sideId) {
    const { sides } = this.state;
    return sides.find(side => (Number(side.id) === Number(sideId)));
  }

  addToOrder(e, product) {
    e.preventDefault();
    const { signedIn } = this.props;
    if (signedIn === false) {
      window.location.href = route('frontend.login');
    } else {
      this.setState({
        productSelected: _.clone(product),
      });
    }
  }

  syncSelectedProductSides(event, dish, sidePosition) {
    const { productSelected } = this.state;

    const dishAsStr = dish.toString();
    const sideAsStr = sidePosition.toString();

    if (productSelected.sides === undefined) {
      productSelected.sides = {};
    }

    if (productSelected.sides[dishAsStr] === undefined) {
      productSelected.sides[dishAsStr] = {};
    }

    if (productSelected.sides[dishAsStr][sideAsStr] === undefined) {
      productSelected.sides[dishAsStr][sideAsStr] = {};
    }

    productSelected.sides[dishAsStr][sideAsStr] = this.getSideById(event.target.value);
    this.setState({ productSelected });
  }

  handleCloseAddProductModal() {
    this.setState({ productSelected: null });
  }

  render() {
    const { product } = this.state;

    return (
      <Modal
        show
        onHide={this.handleCloseAddProductModal}
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
                <input type="text" className="form-control" value={productSelected.name} readOnly />
              </label>
            </div>
            <div className="form-group col-md-4">
              <label htmlFor="dishes-number">
                { trans('frontend.homepage.quantity') }
                <select id="dishes-number" className="form-control" onChange={e => (this.setQuantity(e))} defaultValue={quantity.length}>
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
                onChange={value => this.setState({ pickUpDate: value })}
              />
            </div>
          </div>
          {sidesNav}
          <div className="clearfix" />
        </Modal.Body>
      </Modal>
    );
  }
}

export default AddProductHandler;

AddProductHandler.propTypes = {
  product: PropTypes.shape({}).isRequired,
  signedIn: PropTypes.bool.isRequired,
};
