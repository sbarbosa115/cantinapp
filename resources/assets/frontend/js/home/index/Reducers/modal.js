import {
  SHOW_MODAL_CREATE_ORDER, SHOW_MODAL_ORDER_ADDED, SHOW_MODAL_ORDER_FAILED,
  RESET_MODAL_STATE,
} from '../Actions/modal';

const initialState = {
  createOrder: false,
  orderCreated: false,
  orderCreatedData: {},
  orderFailed: false,
};

export default function modals(state = initialState, action) {
  switch (action.type) {
    case SHOW_MODAL_CREATE_ORDER:
      return Object.assign({}, state, {
        createOrder: action.createOrder,
      });
    case SHOW_MODAL_ORDER_ADDED:
      return Object.assign({}, state, {
        orderCreated: action.orderCreated,
        orderCreatedData: action.orderCreatedData,
      });
    case SHOW_MODAL_ORDER_FAILED:
      return Object.assign({}, state, {
        orderFailed: action.orderFailed,
      });
    case RESET_MODAL_STATE:
      return Object.assign({}, state, {
        ...initialState,
      });
    default:
      return state;
  }
}
