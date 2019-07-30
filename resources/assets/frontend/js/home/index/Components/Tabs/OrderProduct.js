import React from 'react';
import {
  Tab, Tabs, TabList, TabPanel,
} from 'react-tabs';
import { connect } from 'react-redux';
import 'react-tabs/style/react-tabs.css';
import PropTypes from 'prop-types';
import uuid from 'uuid/v4';
import { SET_DEFAULT_TAB } from '../../Actions/order';
import TextareaProduct from '../Base/TextareaProduct';
import MealsDropdown from '../Base/MealsDropdown';
import SidesDropdown from '../Base/SidesDropdown';
import { ConfigurationConsumer } from '../../Context/Configuration';
import BeveragesDropdown from '../Base/BeveragesDropdown';

const mapStateToProps = state => ({
  ...state,
});

const mapDispatchToProps = dispatch => ({
  setDefaultTab: tab => dispatch({
    type: SET_DEFAULT_TAB,
    tab,
  }),
});

const OrderProduct = ({ order, setDefaultTab }) => (
  <ConfigurationConsumer>
    {({ sidesNumber, beveragesNumber }) => (
      <Tabs
        key={uuid()}
        selectedIndex={order.default_tab}
        onSelect={(tabIndex) => {
          setDefaultTab(tabIndex);
        }}
      >
        <TabList>
          {order.products.map((productItem, itemKey) => (
            <Tab key={productItem.id}>
              {`${trans('frontend.homepage.dish')} ${itemKey + 1}`}
            </Tab>
          ))}
        </TabList>
        {order.products.map(productItem => (
          <TabPanel key={productItem.id}>
            <div className="form-group">
              <MealsDropdown
                elementKey={productItem.id}
                value={productItem.product_id}
              />
            </div>
            {Array(Number(sidesNumber)).fill(null).map((sideEmpty, sideIndex) => (
              <div className="form-group" key={uuid()}>
                <SidesDropdown
                  elementKey={productItem.id}
                  sideIndex={sideIndex}
                  value={productItem.sides[sideIndex]}
                />
              </div>
            ))}
            {Array(Number(beveragesNumber)).fill(null).map((sideEmpty, beverageIndex) => (
              <div className="form-group" key={uuid()}>
                <BeveragesDropdown
                  elementKey={productItem.id}
                  beverageIndex={beverageIndex}
                  value={productItem.beverages[beverageIndex]}
                />
              </div>
            ))}
            <div className="form-group">
              <TextareaProduct
                elementKey={productItem.id}
                value={productItem.comment}
              />
            </div>
          </TabPanel>
        ))}
      </Tabs>
    )}
  </ConfigurationConsumer>
);

OrderProduct.propTypes = {
  order: PropTypes.shape({
    default_tab: PropTypes.number,
    products: PropTypes.arrayOf(PropTypes.shape({
      id: PropTypes.string,
      comment: PropTypes.string,
      sides: PropTypes.arrayOf(PropTypes.number),
    })),
  }),
  setDefaultTab: PropTypes.func,
};


OrderProduct.defaultProps = {
  order: {
    default_tab: 0,
    products: [],
  },
  setDefaultTab: () => (''),
};

export default connect(mapStateToProps, mapDispatchToProps)(OrderProduct);
