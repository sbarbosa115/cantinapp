import { Query } from 'react-apollo';
import gql from 'graphql-tag';
import React from 'react';
import PropTypes from 'prop-types';
import { addSideToProduct } from '../../Actions/order';

const SidesDropdown = ({
  store, label, value, elementKey, sideIndex,
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
          {`${trans('frontend.homepage.side')} (${sideIndex + 1})`}
          <select
            className="form-control"
            onChange={(e) => {
              store.dispatch(addSideToProduct(sideIndex, Number(e.target.value), elementKey));
            }}
            defaultValue={value}
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
  store: PropTypes.shape({}).isRequired,
  label: PropTypes.string,
  value: PropTypes.number,
  sideIndex: PropTypes.number,
  elementKey: PropTypes.string.isRequired,
};

SidesDropdown.defaultProps = {
  label: 'Meals',
  value: null,
  sideIndex: 0,
}

export default SidesDropdown;
