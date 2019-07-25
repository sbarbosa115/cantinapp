import { Query } from 'react-apollo';
import gql from 'graphql-tag';
import React from 'react';
import PropTypes from 'prop-types';
import { setProductId } from '../../Actions/order';

const MealsDropdown = ({
  store, label, value, elementKey,
}) => (
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
        // eslint-disable-next-line jsx-a11y/label-has-for
        <label htmlFor={label}>
          {trans('frontend.homepage.this_plate')}
          <select
            className="form-control"
            onChange={(e) => {
              store.dispatch(setProductId(Number(e.target.value), elementKey));
            }}
            defaultValue={value}
            required
          >
            {data.meals
              .map(product => (
                <option
                  key={product.id}
                  value={product.id}
                >
                  {product.name}
                </option>
              ))}
            {data.meals.length === 0 && (
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

MealsDropdown.propTypes = {
  store: PropTypes.shape({}).isRequired,
  label: PropTypes.string,
  value: PropTypes.number,
  elementKey: PropTypes.string.isRequired,
};

MealsDropdown.defaultProps = {
  label: 'Meals',
  value: null,
}

export default MealsDropdown;
