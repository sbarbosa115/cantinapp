import React, { Component } from 'react';
import ScrollableAnchor from 'react-scrollable-anchor';
import PropTypes from 'prop-types';
import { createStore } from 'redux';
import { Provider } from 'react-redux';
import Products from './Products';
import WelcomeHeader from './WelcomeHeader';
import createOrder from '../Reducers/order';
import AddProductModal from './Modals/AddProductModal';
import { addProduct } from '../Actions/order';
import Product from '../Model/Product';
import { ConfigurationProvider } from '../Context/Configuration';
import OrderCreated from './Modals/OrderCreated';
import OrderFailed from './Modals/OrderFailed';

const store = createStore(createOrder);

class OrderHandler extends Component {
  constructor(props) {
    super(props);

    this.state = {
      querySearch: null,
      showModalAddProductHandler: false,
      showModalOrderCreated: false,
      showModalOrderFail: false,
      clickedProduct: {},
    };

    this.modalAddProductHandlerToOrder = this.modalAddProductHandlerToOrder.bind(this);
  }

  modalAddProductHandlerToOrder(product = {}) {
    const { showModalAddProductHandler } = this.state;
    store.dispatch(addProduct(new Product(Number(product.id))));

    this.setState({
      showModalAddProductHandler: !showModalAddProductHandler,
      clickedProduct: product,
    });
  }

  render() {
    const {
      showModalAddProductHandler, showModalOrderCreated, clickedProduct, showModalOrderFail,
    } = this.state;
    let { querySearch } = this.state;
    return (
      <ConfigurationProvider value={this.props}>
        <Provider store={store}>
          <WelcomeHeader />
          <ScrollableAnchor id="start-order">
            <section className="search-content">
              <div className="search-content-wrapper">
                <div className="container">
                  <div className="row">
                    <div className="search-content-group">
                      <div className="search-content-inner">
                        <div id="search">
                          <div className="expanded-message">
                            <div className="search-field">
                              <form className="search" style={{ position: 'relative' }}>
                                <input
                                  type="text"
                                  className="search_box"
                                  placeholder="search our store"
                                  autoComplete="off"
                                  onChange={(e) => {
                                    querySearch = e.target.value;
                                    this.setState({ querySearch });
                                  }}
                                />
                              </form>
                            </div>
                            {querySearch && (
                            <div>
                              <span className="subtext">
                                {'Your search for '}
                                <strong>{querySearch}</strong>
                                {' revealed the following:'}
                              </span>
                            </div>
                            )}
                          </div>
                          <div className="product-item-group clearfix">
                            {<Products
                              querySearch={querySearch}
                              modalAddProductHandlerToOrder={this.modalAddProductHandlerToOrder}
                            />}
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </ScrollableAnchor>
          {showModalAddProductHandler && (
            <AddProductModal
              closeHandler={() => this.setState({ showModalAddProductHandler: false })}
              product={clickedProduct}
              openModalOrderCreated={() => {
                this.setState({
                  showModalOrderCreated: true,
                });
              }}
              openModalOrderFail={() => {
                this.setState({
                  showModalOrderFail: true,
                });
              }}
            />
          )}
          {showModalOrderCreated && (
            <OrderCreated
              orderCreated={{
                order: {
                  pickup_at: '2019-07-26 20:59',
                },
              }}
              onCloseHandler={() => {
                this.setState({
                  showModalOrderCreated: false,
                });
              }}
            />
          )}
          {showModalOrderFail && (
            <OrderFailed
              onCloseHandler={() => {
                this.setState({
                  showModalOrderFail: false,
                });
              }}
            />
          )}
        </Provider>
      </ConfigurationProvider>
    );
  }
}

export default OrderHandler;

OrderHandler.propTypes = {
  signedIn: PropTypes.bool,
  sidesNumber: PropTypes.number,
  beveragesNumber: PropTypes.number,
  pathCreateOrder: PropTypes.string.isRequired,
  pathLogin: PropTypes.string.isRequired,
  imageSuccess: PropTypes.string.isRequired,
  imageError: PropTypes.string.isRequired,
  imageHeader: PropTypes.string.isRequired,
};

OrderHandler.defaultProps = {
  sidesNumber: 3,
  beveragesNumber: 1,
  signedIn: false,
};
