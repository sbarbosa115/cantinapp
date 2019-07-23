import { Query } from 'react-apollo';
import gql from 'graphql-tag';
import React from 'react';
import PropTypes from 'prop-types';
import { addBeverageToProduct } from '../../Actions/order';

const BeveragesDropdown = ({
  store, label, value, elementKey, beverageIndex,
}) => (
  <Query
    query={gql`
      {
        beverages {
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
          {`${trans('frontend.homepage.beverage')} (${beverageIndex + 1})`}
          <select
            className="form-control"
            onChange={(e) => {
              store.dispatch(
                addBeverageToProduct(beverageIndex, Number(e.target.value), elementKey),
              );
            }}
            defaultValue={value}
          >
            {data.beverages.length !== 0 && (
              <option>{`${trans('frontend.homepage.select_beverage')}`}</option>
            )}
            {data.beverages
              .map(beverage => (
                <option key={beverage.id} value={beverage.id}>
                  {beverage.name}
                </option>
              ))}
            {data.beverages.length === 0 && (
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

BeveragesDropdown.propTypes = {
  store: PropTypes.shape({}).isRequired,
  label: PropTypes.string,
  value: PropTypes.number,
  beverageIndex: PropTypes.number,
  elementKey: PropTypes.string.isRequired,
};

BeveragesDropdown.defaultProps = {
  label: 'Meals',
  value: null,
  beverageIndex: 0,
}

export default BeveragesDropdown;
