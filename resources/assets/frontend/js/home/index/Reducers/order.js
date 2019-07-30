import {
  ADD_PRODUCT, CREATE_EMPTY_PRODUCTS, HANDLE_PRODUCT_COMMENT, SET_DEFAULT_TAB, SET_PICK_UP_TIME,
  SET_PRODUCT_ID, ADD_SIDE_TO_PRODUCT, ADD_BEVERAGE_TO_PRODUCT,
} from '../Actions/order';

const initialState = {
  default_tab: 0,
  pickup_at: null,
  products: [],
};

export default function order(state = initialState, action) {
  switch (action.type) {
    case ADD_PRODUCT: {
      const { product } = action;
      return Object.assign({}, state, {
        products: [
          product,
        ],
      });
    }
    case CREATE_EMPTY_PRODUCTS: {
      const productsFinal = action.products.map((actionProduct, index) => {
        if (state.products[index]) {
          return state.products[index];
        }
        return actionProduct;
      });

      const productsState = { products: productsFinal };
      // Setting default tab when products size is equals to 1.
      if (productsFinal.length === 1) {
        productsState.default_tab = 0;
      }
      return Object.assign({}, state, productsState);
    }
    case SET_DEFAULT_TAB:
      return Object.assign({}, state, {
        default_tab: action.tab,
      });
    case HANDLE_PRODUCT_COMMENT:
      return Object.assign({}, state, {
        products: state.products.map((product) => {
          if (product.id === action.productKey) {
            // eslint-disable-next-line no-param-reassign
            product.comment = action.comment;
          }
          return product;
        }),
      });
    case SET_PICK_UP_TIME:
      return Object.assign({}, state, {
        pickup_at: action.pickUpTime,
      });
    case SET_PRODUCT_ID:
      return Object.assign({}, state, {
        products: state.products.map((product) => {
          if (product.id === action.productKey) {
            // eslint-disable-next-line no-param-reassign
            product.product_id = action.productId;
          }
          return product;
        }),
      });
    case ADD_SIDE_TO_PRODUCT: {
      const products = state.products
        .map((product) => {
          if (product.id === action.productKey) {
            const productCopy = product;
            productCopy.sides[action.sideIndex] = action.sideId;
            return productCopy;
          }
          return product;
        });
      return Object.assign({}, state, {
        products,
      });
    }
    case ADD_BEVERAGE_TO_PRODUCT: {
      const products = state.products
        .map((product) => {
          if (product.id === action.productKey) {
            const productCopy = product;
            productCopy.beverages[action.beverageIndex] = action.beverageId;
            return productCopy;
          }
          return product;
        });
      return Object.assign({}, state, {
        products,
      });
    }
    default:
      return state;
  }
}
