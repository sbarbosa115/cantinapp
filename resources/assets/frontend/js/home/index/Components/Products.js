import React from 'react';
import PropTypes from 'prop-types';
import 'react-tabs/style/react-tabs.css';
import 'animate.css';
import MealsList from './Base/MealsList';

const Products = ({ querySearch, modalAddProductHandlerToOrder }) => (
  <React.Fragment>
    {<MealsList
      querySearch={querySearch}
      modalAddProductHandlerToOrder={modalAddProductHandlerToOrder}
    />}
  </React.Fragment>
);

Products.propTypes = {
  querySearch: PropTypes.string,
  modalAddProductHandlerToOrder: PropTypes.func.isRequired,
};

Products.defaultProps = {
  querySearch: null,
};

export default Products;
