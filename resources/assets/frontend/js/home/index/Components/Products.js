import React from 'react';
import PropTypes from 'prop-types';
import { Query } from 'react-apollo';
import 'react-tabs/style/react-tabs.css';
import 'animate.css';
import gql from 'graphql-tag';
import Product from './Product';

const Meals = ({ querySearch, modalAddProductHandlerToOrder }) => (
  <Query
    query={gql`
      {
        meals {
          id name image_path
        }
      }
    `}
  >
    {({ loading, error, data }) => {
      if (loading) return <p>Loading...</p>;
      if (error) return <p>Error :(</p>;

      return (
        <div>
          {data.meals
          // eslint-disable-next-line max-len
            .filter(product => querySearch === null || product.name.toLowerCase().includes(querySearch.toLowerCase()))
            .map(product => (
              <Product
                key={`product-${product.id}`}
                modalAddProductHandlerToOrder={modalAddProductHandlerToOrder}
                signedIn={false}
                product={product}
              />
            ))}
          {data.meals.length === 0 && (
            <p>{trans('frontend.homepage.no_results')}</p>
          )}
        </div>
      );
    }}
  </Query>
);

Meals.propTypes = {
  querySearch: PropTypes.string,
  modalAddProductHandlerToOrder: PropTypes.func.isRequired,
};

Meals.defaultProps = {
  querySearch: null,
};

const Products = ({ querySearch, modalAddProductHandlerToOrder }) => (
  <React.Fragment>
    {<Meals
      querySearch={querySearch}
      modalAddProductHandlerToOrder={modalAddProductHandlerToOrder}
    />}
  </React.Fragment>
);

export default Products;

Products.propTypes = {
  querySearch: PropTypes.string,
  modalAddProductHandlerToOrder: PropTypes.func.isRequired,
};

Products.defaultProps = {
  querySearch: null,
};
