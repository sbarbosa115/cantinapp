import { Query } from 'react-apollo';
import gql from 'graphql-tag';
import { connect } from 'react-redux';
import React from 'react';
import PropTypes from 'prop-types';
import { ADD_BEVERAGE_TO_PRODUCT } from '../../Actions/order';
import { ConfigurationConsumer } from '../../Context/Configuration';

const mapStateToProps = state => ({
  ...state,
});

const mapDispatchToProps = dispatch => ({
  addBeverageToProduct: (beverageIndex, beverageId, productKey) => dispatch({
    type: ADD_BEVERAGE_TO_PRODUCT,
    beverageIndex,
    beverageId,
    productKey,
  }),
});

const BeveragesDropdown = ({
  label, value, elementKey, beverageIndex, addBeverageToProduct,
}) => (
  <ConfigurationConsumer>
    {({ sourceProductsId }) => (
      <Query
        query={gql`
            {
              beveragesICanSee(restaurant: ${sourceProductsId}) {
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
              {!value && <i className="fas fa-arrow-right animated rotateIn" aria-hidden="true" />}
              {`${trans('frontend.homepage.beverage')} (${beverageIndex + 1})`}
              <select
                className="form-control"
                onChange={(e) => {
                  addBeverageToProduct(beverageIndex, Number(e.target.value), elementKey);
                }}
                defaultValue={value || ''}
              >
                {data.beveragesICanSee.length !== 0 && (
                  <option>{`${trans('frontend.homepage.select_beverage')}`}</option>
                )}
                {data.beveragesICanSee
                  .map(beverage => (
                    <option key={beverage.id} value={beverage.id}>
                      {beverage.name}
                    </option>
                  ))}
                {data.beveragesICanSee.length === 0 && (
                  <option>
                    {trans('frontend.homepage.no_results')}
                  </option>
                )}
              </select>
            </label>
          );
        }}
      </Query>
    )}
  </ConfigurationConsumer>
);

BeveragesDropdown.propTypes = {
  label: PropTypes.string,
  value: PropTypes.number,
  beverageIndex: PropTypes.number,
  elementKey: PropTypes.string.isRequired,
  addBeverageToProduct: PropTypes.func,
};

BeveragesDropdown.defaultProps = {
  label: 'Meals',
  value: null,
  beverageIndex: 0,
  addBeverageToProduct: () => (''),
};

export default connect(mapStateToProps, mapDispatchToProps)(BeveragesDropdown);
