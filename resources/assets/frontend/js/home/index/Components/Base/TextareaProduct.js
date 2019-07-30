import React, { useState } from 'react';
import PropTypes from 'prop-types';
import { connect } from 'react-redux';
import { HANDLE_PRODUCT_COMMENT } from '../../Actions/order';

const mapStateToProps = state => ({
  ...state,
});

const mapDispatchToProps = dispatch => ({
  handleProductComment: (value, elementKey) => dispatch({
    type: HANDLE_PRODUCT_COMMENT,
    comment: value,
    productKey: elementKey,
  }),
});

const TextareaProduct = ({
  handleProductComment, elementKey, order, label,
}) => {
  const [value, setValue] = useState(order.products
    .filter(productItem => productItem.id === elementKey)
    .reduce((acc, productItem) => (productItem.comment), null) || '');

  return (
    <label htmlFor={label}>
      {trans('frontend.homepage.special_dish_requirements')}
      <textarea
        className="form-control"
        onChange={event => (
          setValue(event.target.value)
        )}
        onBlur={(event) => {
          handleProductComment(event.target.value, elementKey);
        }}
        value={value}
      />
    </label>
  );
}

TextareaProduct.propTypes = {
  order: PropTypes.shape({
    default_tab: PropTypes.number,
    products: PropTypes.arrayOf(PropTypes.shape({
      id: PropTypes.string,
      comment: PropTypes.string,
      sides: PropTypes.arrayOf(PropTypes.number),
    })),
  }),
  label: PropTypes.string,
  elementKey: PropTypes.string.isRequired,
  handleProductComment: PropTypes.func,
};

TextareaProduct.defaultProps = {
  label: 'label',
  order: {
    default_tab: 0,
    products: [],
  },
  handleProductComment: () => (''),
};

export default connect(mapStateToProps, mapDispatchToProps)(TextareaProduct);
