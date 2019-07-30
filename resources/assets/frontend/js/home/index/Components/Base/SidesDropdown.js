import { Query } from 'react-apollo';
import gql from 'graphql-tag';
import React from 'react';
import { connect } from 'react-redux';
import PropTypes from 'prop-types';
import { ADD_SIDE_TO_PRODUCT } from '../../Actions/order';

const mapStateToProps = state => ({
  ...state,
});

const mapDispatchToProps = dispatch => ({
  addSideToProduct: (sideIndex, sideId, productKey) => dispatch({
    type: ADD_SIDE_TO_PRODUCT,
    sideIndex,
    sideId,
    productKey,
  }),
});

const SidesDropdown = ({
  label, value, elementKey, sideIndex, addSideToProduct,
}) => (
  <Query
    query={gql`
      {
        sides {
          id name
        }
      }
    `}
  >
    {({ loading, error, data }) => {
      if (loading) return <p>Loading...</p>;
      if (error) return <p>Error :(</p>;
      return (
        // eslint-disable-next-line jsx-a11y/label-has-for
        <label htmlFor={label}>
          {!value && <i className="fa fa-arrow-right animated rotateIn" aria-hidden="true" />}
          {`${trans('frontend.homepage.side')} (${sideIndex + 1})`}
          <select
            className="form-control"
            onChange={(e) => {
              addSideToProduct(sideIndex, Number(e.target.value), elementKey);
            }}
            defaultValue={value || ''}
          >
            {data.sides.length !== 0 && (
              <option>{trans('frontend.homepage.select_side')}</option>
            )}
            {data.sides
              .map(side => (
                <option
                  key={side.id}
                  value={side.id}
                >
                  {side.name}
                </option>
              ))}
            {data.sides.length === 0 && (
              <option>
                {trans('frontend.homepage.no_results')}
              </option>
            )}
          </select>
        </label>
      );
    }}
  </Query>
);

SidesDropdown.propTypes = {
  label: PropTypes.string,
  value: PropTypes.number,
  sideIndex: PropTypes.number,
  elementKey: PropTypes.string.isRequired,
};

SidesDropdown.defaultProps = {
  label: 'Meals',
  value: null,
  sideIndex: 0,
};


export default connect(mapStateToProps, mapDispatchToProps)(SidesDropdown);
