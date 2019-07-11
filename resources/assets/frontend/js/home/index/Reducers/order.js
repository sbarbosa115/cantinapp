import { combineReducers } from 'redux';
import { ADD_PRODUCT } from '../Actions/order';

const initialState = {
  // pickup_at: null,
  order: [],
};

function order(state = initialState, action) {
  switch (action.type) {
    case ADD_PRODUCT:
      return Object.assign({}, state, {
        order: [
          ...state.order,
          {
            id: null,
            sides: [],
          },
        ],
      });
    default:
      return state;
  }
}


const createOrder = combineReducers({
  order,
});

export default createOrder;
