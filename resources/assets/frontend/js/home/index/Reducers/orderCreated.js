import { combineReducers } from 'redux';
import { ADD_ORDER_CREATED } from '../Actions/orderCreated';

const initialState = {
  pickup_at: null,
};

function orderCreated(state = initialState, action) {
  switch (action.type) {
    case ADD_ORDER_CREATED:
      return Object.assign({}, state, {
        ...action.order,
      });
    default:
      return state;
  }
}

const createOrder = combineReducers({
  orderCreated,
});

export default createOrder;
