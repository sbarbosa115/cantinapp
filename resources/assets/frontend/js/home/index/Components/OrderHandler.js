import React, { Component } from 'react';
import ScrollableAnchor from 'react-scrollable-anchor';
import PropTypes from 'prop-types';
import { createStore } from 'redux';
import { Provider } from 'react-redux';
import Products from './Products';
import WelcomeHeader from './WelcomeHeader';
import createOrder from '../Reducers/order';
import { AddProductModal } from './Modals';


const store = createStore(createOrder);

class OrderHandler extends Component {
  constructor(props) {
    super(props);

    this.state = {
      querySearch: null,
      showModalAddProductHandler: false,
      clickedProduct: {},
    };

    this.modalAddProductHandlerToOrder = this.modalAddProductHandlerToOrder.bind(this);
  }

  modalAddProductHandlerToOrder(product = {}) {
    const { showModalAddProductHandler } = this.state;
    this.setState({
      showModalAddProductHandler: !showModalAddProductHandler,
      clickedProduct: product,
    });
  }

  render() {
    const { showModalAddProductHandler, clickedProduct } = this.state;
    let { querySearch } = this.state;

    return (
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
                            <form className="search" action="#" style={{ position: 'relative' }}>
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
        {showModalAddProductHandler && <AddProductModal product={clickedProduct} />}
      </Provider>
    );
  }
}

export default OrderHandler;

OrderHandler.propTypes = {
  signedIn: PropTypes.bool.isRequired,
};
