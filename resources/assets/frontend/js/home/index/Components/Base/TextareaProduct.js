import React, { Component } from 'react';
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

class TextareaProduct extends Component {
  constructor(props) {
    super(props);

    this.state = {
      value: props.value,
    };
  }

  render() {
    const {
      label, elementKey, handleProductComment, order,
    } = this.props;
    return (
      <label htmlFor={label}>
        {trans('frontend.homepage.special_dish_requirements')}
        <textarea
          className="form-control"
          onChange={(event) => {
            handleProductComment(event.target.value, elementKey);
          }}
          value={order.products.filter(productItem => productItem.id === elementKey)
            .reduce((acc, productItem) => (productItem.comment), null)}
        />
      </label>
    );
  }
}

TextareaProduct.propTypes = {
  label: PropTypes.string,
  value: PropTypes.string,
  elementKey: PropTypes.string.isRequired,
};

TextareaProduct.defaultProps = {
  label: 'label',
  value: '',
};

export default connect(mapStateToProps, mapDispatchToProps)(TextareaProduct);
