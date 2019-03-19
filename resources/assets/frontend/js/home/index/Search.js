import React, { Component } from 'react';
import ScrollableAnchor from 'react-scrollable-anchor';
import PropTypes from 'prop-types';
import Product from './Product';
import WelcomeHeader from './WelcomeHeader';

class Search extends Component {
  constructor(props) {
    super(props);

    this.state = {
      sides: props.sides,
      categories: props.categories,
      query: false,
    };

    this.onSearch = this.onSearch.bind(this);
  }

  onSearch(e) {
    const query = e.target.value || false;
    this.setState({ query });
  }

  render() {
    const { query, categories, sides } = this.state;
    const { signedIn } = this.props;
    const products = [];

    categories.forEach((category) => {
      category.products.filter(product => (product.status !== 'disabled')).forEach((product) => {
        if (
          (query && product.name.toLowerCase().search(query.toLowerCase()) > -1) || query === false
        ) {
          products.push(<Product
            sides={sides}
            key={`product-${product.id}`}
            product={product}
            signedIn={signedIn}
          />);
        }
      });
    });

    return (
      <div>
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
                                name="q"
                                className="search_box"
                                placeholder="search our store"
                                autoComplete="off"
                                onChange={e => this.onSearch(e)}
                              />
                            </form>
                          </div>
                          {query && (
                          <div>
                            <span className="subtext">
                              {`Your search for <strong>${query}</strong> revealed the following:`}
                            </span>
                            <span className="results">
                              {`${products.length} results found`}
                            </span>
                          </div>
                          )}
                        </div>
                        <div className="product-item-group clearfix">
                          {products}
                        </div>
                        {products.length > 0
                        && (
                          <div className="search-bottom-toolbar">
                            <div className="search-pagination col-sm-6" />
                            <div className="search-counter col-sm-6">
                              {`Items 1 to ${products.length} total`}
                            </div>
                          </div>
                        )}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </section>
        </ScrollableAnchor>
      </div>
    );
  }
}

export default Search;

Search.propTypes = {
  categories: PropTypes.arrayOf(PropTypes.shape({})).isRequired,
  sides: PropTypes.arrayOf(PropTypes.shape({})).isRequired,
  signedIn: PropTypes.bool.isRequired,
};
