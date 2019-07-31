import React from 'react';
import { configure, shallow } from 'enzyme';
import { MockedProvider } from 'react-apollo/test-utils';
import Adapter from 'enzyme-adapter-react-16';
import OrderForbbiden from '../../../../../../resources/assets/frontend/js/home/index/Components/Modals/OrderForbbiden';

global.trans = jest.fn(trans => (trans));
configure({ adapter: new Adapter() });

it('renders without crashing', () => {
  shallow(
    <MockedProvider>
      <OrderForbbiden />
    </MockedProvider>,
  );
});
