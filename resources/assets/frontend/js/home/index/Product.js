import React, { Component } from 'react';
import Modal from 'react-bootstrap-modal';
import PropTypes from 'prop-types';
import DateTimePicker from 'react-widgets/lib/DateTimePicker';
import momentLocalizer from 'react-widgets-moment';
import moment from 'moment';
import _ from 'lodash';
import {
  Tab, Tabs, TabList, TabPanel,
} from 'react-tabs';
import 'react-tabs/style/react-tabs.css';
import 'animate.css';


const ALLOWED_MEAL_SIDES = [...Array(2).keys()];
const ALLOWED_BEVERAGE_SIDES = [...Array(1).keys()];
moment.locale('en');
momentLocalizer();

/* global trans */
/* global axios */
/* global route */
/* global window */
class Product extends Component {
  constructor(props) {
    super(props);

    this.state = {
      sides: props.sides,
      product: props.product,
      productSelected: null,
      quantity: [0],
      tabSelectedIndex: 0,
      pickUpDate: null,
      orderCreated: null,
      orderNotCreated: null,
    };

    this.handleCloseAddProductModal = this.handleCloseAddProductModal.bind(this);
    this.handleCloseOrderNotCreatedModal = this.handleCloseOrderNotCreatedModal.bind(this);
    this.handleCloseOrderCreatedModal = this.handleCloseOrderCreatedModal.bind(this);
    this.syncSelectedProductSides = this.syncSelectedProductSides.bind(this);
    this.setQuantity = this.setQuantity.bind(this);
  }

  getBeverageSides() {
    const { sides } = this.state;
    return sides.filter(side => (side.tags.filter(tag => tag.slug === 'juice').length > 0));
  }

  getMealSides() {
    const { sides } = this.state;
    return sides.filter(side => (side.tags.filter(tag => tag.slug === 'meals').length > 0));
  }

  getSideById(sideId) {
    const { sides } = this.state;
    return sides.find(side => (Number(side.id) === Number(sideId)));
  }

  getSelectedProductSide(dish, sidePosition) {
    const { productSelected } = this.state;
    const dishAsStr = dish.toString();
    const sideAsStr = sidePosition.toString();

    if (
      productSelected !== null
      && productSelected.sides !== undefined
      && productSelected.sides[dishAsStr] !== undefined
      && productSelected.sides[dishAsStr][sideAsStr] !== undefined
    ) {
      return productSelected.sides[dishAsStr][sideAsStr].id;
    }
    return undefined;
  }

  getCommentsByDish(dish) {
    const { productSelected } = this.state;
    const dishAsStr = dish.toString();

    if (
      productSelected !== null
      && productSelected.sides !== undefined
      && productSelected.sides[dishAsStr] !== undefined
      && productSelected.sides[dishAsStr].comment !== undefined
    ) {
      return productSelected.sides[dishAsStr].comment;
    }
    return '';
  }

  setQuantity(e) {
    const { productSelected, quantity } = this.state;
    if (productSelected !== null && productSelected.sides !== undefined) {
      Object.keys(productSelected.sides).forEach((sideId) => {
        if (sideId > (quantity.length - 1)) {
          delete productSelected.sides[sideId];
        }
      });
    }

    this.setState({
      quantity: [...Array(Number(e.target.value)).keys()],
      tabSelectedIndex: 0,
    });
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

  syncCommentByDish(dish, comment) {
    const { productSelected } = this.state;
    const dishAsStr = dish.toString();
    if (productSelected !== null) {
      if (productSelected.sides === undefined) {
        productSelected.sides = {};
      }

      if (productSelected.sides[dishAsStr] === undefined) {
        productSelected.sides[dishAsStr] = {};
        productSelected.sides[dishAsStr].comment = '';
      }

      productSelected.sides[dishAsStr].comment = comment;
      this.setState({ productSelected });
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

  handleCloseOrderCreatedModal() {
    this.setState({ orderCreated: null });
  }

  handleCloseOrderNotCreatedModal() {
    this.setState({ orderNotCreated: null });
  }

  handleValidation() {
    const { productSelected, pickUpDate } = this.state;
    if (productSelected === null) {
      return false;
    }

    if (pickUpDate === null) {
      return false;
    }

    if (productSelected.sides === undefined) {
      return false;
    }

    if (Object.keys(productSelected.sides).length === 0) {
      return false;
    }

    return true;
  }

  handleSubmitOrder() {
    const { productSelected, pickUpDate } = this.state;
    productSelected.pickup_at = moment(pickUpDate).format('HH:mm');
    axios.post(route('frontend.order.store'), productSelected).then(
      (response) => {
        this.setState({
          orderCreated: response.data,
          productSelected: null,
        });
      },
      () => {
        this.setState({
          orderNotCreated: true,
          productSelected: null,
        });
      },
    );
  }

  render() {
    const {
      product, productSelected, quantity, tabSelectedIndex,
      orderCreated, orderNotCreated,
    } = this.state;

    const roundedUp = Math.ceil(moment().minute() / 15) * 15;

    const sidesNav = (
      <Tabs
        selectedIndex={tabSelectedIndex}
        onSelect={tabIndex => this.setState({ tabSelectedIndex: tabIndex })}
      >
        <TabList>
          {quantity.map(quantityItem => (
            <Tab key={quantityItem + 1}>
              {`${trans('frontend.homepage.dish')} ${quantityItem + 1}`}
            </Tab>
          ))}
        </TabList>
        {quantity.map(quantityItem => (
          <TabPanel key={quantityItem}>
            {ALLOWED_BEVERAGE_SIDES.map(allowed => (
              <label key={`side-beverage-${allowed}`} htmlFor={`side-beverage-${allowed}`}>
                {`${trans('frontend.homepage.beverage')} ${trans('frontend.homepage.side')} #${allowed + 1}` }
                <select
                  id={`side-beverage-${allowed}`}
                  className="form-control"
                  value={this.getSelectedProductSide(tabSelectedIndex, allowed)}
                  onChange={e => (this.syncSelectedProductSides(e, tabSelectedIndex, allowed))}
                >
                  <option>{trans('frontend.homepage.index')}</option>
                  {this.getBeverageSides().map(side => (
                    <option value={side.id} key={side.id}>{side.name}</option>
                  ))}
                </select>
              </label>
            ))}
            {ALLOWED_MEAL_SIDES.map(allowed => (
              <label key={`side-meal-${allowed}`} htmlFor={`side-meal-${allowed}`}>
                {`${trans('frontend.homepage.meal')} ${trans('frontend.homepage.side')} #${allowed + 1}` }
                <select
                  id={`side-meal-${allowed}`}
                  className="form-control"
                  value={this.getSelectedProductSide(
                    tabSelectedIndex, (ALLOWED_BEVERAGE_SIDES.length + Number(allowed)),
                  )}
                  onChange={e => (this.syncSelectedProductSides(
                    e, tabSelectedIndex, (ALLOWED_BEVERAGE_SIDES.length + Number(allowed)),
                  ))}
                >
                  <option>{trans('frontend.homepage.index')}</option>
                  {this.getMealSides().map(side => (
                    <option value={side.id} key={side.id}>{side.name}</option>
                  ))}
                </select>
              </label>
            ))}
            <div className="form-group">
              <label htmlFor="comments">
                {trans('frontend.homepage.special_dish_requirements')}
                <textarea
                  className="form-control"
                  onChange={event => this.syncCommentByDish(tabSelectedIndex, event.target.value)}
                  value={this.getCommentsByDish(tabSelectedIndex)}
                />
              </label>
            </div>
            <div className="form-group">
              <button
                type="button"
                className="btn btn-success btn-lg btn-block"
                onClick={() => this.handleSubmitOrder()}
                disabled={!this.handleValidation()}
              >
                {trans('frontend.homepage.create_order')}
              </button>
            </div>
          </TabPanel>
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
                      <input name="quantity" value="1" type="hidden" readOnly />
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
          )
        }
        {
          orderCreated && (
            <Modal
              show
              onHide={this.handleCloseOrderCreatedModal}
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
                    <img src="/images/cooking.jpg" alt="Cooking your order" className="img-responsive" />
                  </div>
                  <div className="clearfix" />
                </div>
              </Modal.Body>
            </Modal>
          )
        }
        {
          orderNotCreated && (
            <Modal
              show
              onHide={this.handleCloseOrderNotCreatedModal}
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
                    <img src="/images/error.png" alt="Error trying to create your order" className="img-responsive" />
                  </div>
                  <div className="clearfix" />
                </div>
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
  signedIn: PropTypes.bool.isRequired,
};
