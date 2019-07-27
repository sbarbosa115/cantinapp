import { Query } from 'react-apollo';
import gql from 'graphql-tag';
import React from 'react';
import PropTypes from 'prop-types';
import Product from '../Product';

const MealsList = ({ querySearch, modalAddProductHandlerToOrder }) => (
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

MealsList.propTypes = {
  querySearch: PropTypes.string,
  modalAddProductHandlerToOrder: PropTypes.func.isRequired,
};

MealsList.defaultProps = {
  querySearch: null,
};

export default MealsList;
