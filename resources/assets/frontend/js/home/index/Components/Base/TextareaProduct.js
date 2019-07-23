import React, { Component } from 'react';
import PropTypes from 'prop-types';
import { handleProductComment } from '../../Actions/order';

class TextareaProduct extends Component {
  constructor(props) {
    super(props);

    this.state = {
      value: props.value,
    };
  }

  render() {
    const { value } = this.state;
    const { label, elementKey, store } = this.props;
    return (
      <label htmlFor={label}>
        {trans('frontend.homepage.special_dish_requirements')}
        <textarea
          className="form-control"
          onChange={(event) => {
            store.dispatch(handleProductComment(value, elementKey));
            this.setState({
              value: event.target.value,
            });
          }}
          value={value}
        />
      </label>
    );
  }
}

export default TextareaProduct;

TextareaProduct.propTypes = {
  store: PropTypes.shape({}).isRequired,
  label: PropTypes.string,
  value: PropTypes.string,
  elementKey: PropTypes.string.isRequired,
};

TextareaProduct.defaultProps = {
  label: 'label',
  value: '',
};
