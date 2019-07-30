import React, { Component } from 'react';
import ScrollableAnchor from 'react-scrollable-anchor';
import PropTypes from 'prop-types';
import { createStore } from 'redux';
import { Provider } from 'react-redux';
import Products from './Products';
import WelcomeHeader from './WelcomeHeader';
import initReducers from '../Reducers/reducers';
import AddProductModal from './Modals/AddProductModal';
import { addProduct } from '../Actions/order';
import Product from '../Model/Product';
import { ConfigurationProvider } from '../Context/Configuration';
import OrderCreated from './Modals/OrderCreated';
import OrderFailed from './Modals/OrderFailed';
import { SHOW_MODAL_CREATE_ORDER } from '../Actions/modal';

const store = createStore(initReducers);

const toggleCreateOrderModal = (flag = false) => ({
  type: SHOW_MODAL_CREATE_ORDER,
  createOrder: flag,
});

class OrderHandler extends Component {
  constructor(props) {
    super(props);

    this.state = {
      querySearch: null,
      clickedProduct: {},
    };

    this.modalAddProductHandlerToOrder = this.modalAddProductHandlerToOrder.bind(this);
  }

  modalAddProductHandlerToOrder(product = {}) {
    store.dispatch(addProduct(new Product(Number(product.id))));
    store.dispatch(toggleCreateOrderModal(true));
    this.setState({
      clickedProduct: product,
    });
  }

  render() {
    const { clickedProduct } = this.state;
    let { querySearch } = this.state;
    const { modals } = store.getState();
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
          {modals.createOrder && (
            <AddProductModal
              forceUpdate={() => this.forceUpdate()}
              product={clickedProduct}
              openModalOrderCreated={() => {
                store.dispatch(toggleCreateOrderModal(true));
              }}
            />
          )}
          {modals.orderCreated && (
            <OrderCreated
              forceUpdate={() => this.forceUpdate()}
            />
          )}
          {modals.orderFailed && (
            <OrderFailed
              forceUpdate={() => this.forceUpdate()}
            />
          )}
        </Provider>
      </ConfigurationProvider>
    );
  }
}

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

export default OrderHandler;
