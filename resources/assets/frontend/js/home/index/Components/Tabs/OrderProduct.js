import React from 'react';
import PropTypes from 'prop-types';
import {
  Tab, Tabs, TabList, TabPanel,
} from 'react-tabs';
import 'react-tabs/style/react-tabs.css';
import uuid from 'react-tabs/esm/helpers/uuid';
import { setDefaultTab } from '../../Actions/order';
import TextareaProduct from '../Base/TextareaProduct';
import MealsDropdown from '../Base/MealsDropdown';
import SidesDropdown from '../Base/SidesDropdown';
import { ConfigurationConsumer } from '../../Context/Configuration';
import BeveragesDropdown from '../Base/BeveragesDropdown';

const OrderProduct = ({ store, forceUpdate }) => {
  const { order } = store.getState();
  return (
    <ConfigurationConsumer>
      {({ sidesNumber, beveragesNumber }) => (
        <Tabs
          key={uuid()}
          selectedIndex={order.default_tab}
          onSelect={(tabIndex) => {
            store.dispatch(setDefaultTab(tabIndex));
            forceUpdate();
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
                  store={store}
                  value={productItem.product_id}
                />
              </div>
              {Array(Number(sidesNumber)).fill(null).map((sideEmpty, sideIndex) => (
                <div className="form-group" key={uuid()}>
                  <SidesDropdown
                    store={store}
                    elementKey={productItem.id}
                    sideIndex={sideIndex}
                    value={productItem.sides[sideIndex]}
                  />
                </div>
              ))}
              {Array(Number(beveragesNumber)).fill(null).map((sideEmpty, beverageIndex) => (
                <div className="form-group" key={uuid()}>
                  <BeveragesDropdown
                    store={store}
                    elementKey={productItem.id}
                    beverageIndex={beverageIndex}
                    value={productItem.beverages[beverageIndex]}
                  />
                </div>
              ))}
              <div className="form-group">
                <TextareaProduct
                  store={store}
                  elementKey={productItem.id}
                  value={productItem.comment}
                />
              </div>
              <div className="form-group">
                <button
                  type="button"
                  className="btn btn-success btn-lg btn-block"
                  onClick={() => console.log(store.getState())}
                >
                  {trans('frontend.homepage.create_order')}
                </button>
              </div>
            </TabPanel>
          ))}
        </Tabs>
      )}
    </ConfigurationConsumer>
  );
};

export default OrderProduct;

OrderProduct.propTypes = {
  store: PropTypes.shape({}).isRequired,
  forceUpdate: PropTypes.func.isRequired,
};
