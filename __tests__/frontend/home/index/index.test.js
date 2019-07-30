import React from 'react';
import { configure, shallow } from 'enzyme';
import { MockedProvider } from 'react-apollo/test-utils';
import Adapter from 'enzyme-adapter-react-16';
import OrderHandler from '../../../../resources/assets/frontend/js/home/index/Components/OrderHandler';

const FAKE_URL = 'FAKE';
global.trans = jest.fn(trans => (trans));
configure({ adapter: new Adapter() });

it('renders without crashing', () => {
  shallow(
    <MockedProvider>
      <OrderHandler
        pathLogin={FAKE_URL}
        pathCreateOrder={FAKE_URL}
        imageSuccess={FAKE_URL}
        imageError={FAKE_URL}
        imageHeader={FAKE_URL}
      />
    </MockedProvider>,
  );
});
