import React, { Component } from 'react';
import Modal from 'react-bootstrap-modal';
import PropTypes from 'prop-types';
import {Tabs, Tab} from 'react-bootstrap-tabs';

const ALLOWED_MEAL_SIDES = [...Array(3).keys()];
const ALLOWED_BEVERAGE_SIDES = [...Array(1).keys()];
/* global trans */
class Product extends Component {
  constructor(props) {
    super(props);

    this.state = {
      sides: props.sides,
      product: props.product,
      productSelected: null,
      quantity: [0],
    };

    this.handleCloseAddProductModal = this.handleCloseAddProductModal.bind(this);
    this.setQuantity = this.setQuantity.bind(this);
  }

  setQuantity(e) {
    this.setState({ quantity: [...Array(Number(e.target.value)).keys()] });
  }

  addToOrder(e, product) {
    e.preventDefault();
    this.setState({
      productSelected: product,
    });
  }

  handleCloseAddProductModal() {
    this.setState({ productSelected: null });
  }

  render() {
    const {
      product, productSelected, sides, quantity,
    } = this.state;

    const sidesNav = (
      <Tabs
        className="tab-container-with-green-border"
        headerClass="tab-header-bold"
        activeHeaderClass="tab-header-blue"
        contentClass="tab-content-yellow"
      >
        {quantity.map(quantityItem => (
          <Tab label={`${trans('frontend.homepage.dish')} ${quantityItem + 1}`}>
            {ALLOWED_BEVERAGE_SIDES.map(allowed => (
              <label key={allowed}>
                Dish 1 juice side
                <select className="form-control">
                  <option>{trans('frontend.homepage.index')}</option>
                  {sides.map(side => (
                    <option value={side.id}>{side.name}</option>
                  ))}
                </select>
              </label>
            ))}
            {ALLOWED_MEAL_SIDES.map(allowed => (
              <label key={allowed}>
                Dish 1 juice side
                <select className="form-control">
                  <option>{trans('frontend.homepage.index')}</option>
                  {sides.map(side => (
                    <option value={side.id}>{side.name}</option>
                  ))}
                </select>
              </label>
            ))}
            <div className="form-group col-md-12">
              <label htmlFor="inputCity">
                {trans('frontend.homepage.special_order_requirements')}
                <textarea className="form-control" />
              </label>
            </div>
          </Tab>
        ))}
      </Tabs>
    );

    return (
      <div className="content_product col-sm-3 fadeInUp animated" data-animate="fadeInUp" data-delay="100">
        <div className="row-container product list-unstyled clearfix product-circle">
          <div className="row-left">
            <a
              href
              onClick={(e) => {
                e.preventDefault();
              }}
              className="hoverBorder container_item"
            >
              <div className="hoverBorderWrapper">
                <img src={product.image_path} className="img-responsive front" alt={product.name} />
                <div className="mask" />
              </div>
            </a>
            <div className="hover-mask">
              <div className="group-mask">
                <div className="inner-mask">
                  <form action="#" method="post">
                    <div className="effect-ajax-cart">
                      <input name="quantity" value="1" type="hidden" />
                      <button
                        type="button"
                        className="_btn add-to-cart"
                        data-parent=".parent-fly"
                        onClick={e => this.addToOrder(e, product)}
                        title={trans('frontend.homepage.add_to_order')}
                      >
                        {trans('frontend.homepage.add_to_order')}
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div className="product-label">
              <div className="label-element new-label">
                <span>
                  {trans('frontend.homepage.new')}
                </span>
              </div>
            </div>
          </div>
          <div className="row-right animMix">
            <div className="product-title">
              <a className="title-5" href onClick={event => event.preventDefault()}>{ product.name }</a>
            </div>
            <div className="product-price">
              <span className="price">
                <span
                  className="money"
                  data-currency-usd={product.name}
                >
                  { product.currency }
                </span>
              </span>
            </div>
          </div>
        </div>
        { productSelected
          && (
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
                      <input type="text" className="form-control" value={productSelected.name} />
                    </label>
                  </div>
                  <div className="form-group col-md-4">
                    <label htmlFor="dishes-number">
                      { trans('frontend.homepage.quantity') }
                      <select name="quantity" className="form-control" onChange={e => (this.setQuantity(e))} value={quantity.length}>
                        <option value="1">{`1 ${trans('frontend.homepage.dish')}`}</option>
                        <option value="2">{`2 ${trans('frontend.homepage.dishes')}`}</option>
                        <option value="3">{`3 ${trans('frontend.homepage.dishes')}`}</option>
                      </select>
                    </label>
                  </div>
                </div>
                {sidesNav}
                <div className="clearfix" />
              </Modal.Body>
            </Modal>
          )
        }
      </div>
    );
  }
}

export default Product;

Product.propTypes = {
  product: PropTypes.shape({}).isRequired,
  sides: PropTypes.arrayOf(PropTypes.shape({})).isRequired,
};
