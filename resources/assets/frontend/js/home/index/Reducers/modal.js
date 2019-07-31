import {
  SHOW_MODAL_CREATE_ORDER, SHOW_MODAL_ORDER_ADDED, SHOW_MODAL_ORDER_FAILED,
  RESET_MODAL_STATE, SHOW_MODAL_ORDER_FORBIDDEN,
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
    case SHOW_MODAL_ORDER_FORBIDDEN:
      return Object.assign({}, state, {
        orderForbidden: action.orderForbidden,
      });
    case RESET_MODAL_STATE:
      return Object.assign({}, state, {
        ...initialState,
      });
    default:
      return state;
  }
}
