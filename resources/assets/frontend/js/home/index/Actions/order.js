export const ADD_PRODUCT = 'ADD_PRODUCT';
export const CREATE_EMPTY_PRODUCTS = 'CREATE_EMPTY_PRODUCTS';
export const SET_DEFAULT_TAB = 'SET_DEFAULT_TAB';
export const SET_PICK_UP_TIME = 'SET_PICK_UP_TIME';
export const SET_PRODUCT_ID = 'SET_PRODUCT_ID';
export const HANDLE_PRODUCT_COMMENT = 'HANDLE_PRODUCT_COMMENT';
export const ADD_SIDE_TO_PRODUCT = 'ADD_SIDE_TO_PRODUCT';
export const ADD_BEVERAGE_TO_PRODUCT = 'ADD_BEVERAGE_TO_PRODUCT';


export const addProduct = product => ({
  type: ADD_PRODUCT,
  product,
});

export const createEmptyProducts = products => ({
  type: CREATE_EMPTY_PRODUCTS,
  products,
});

export const setDefaultTab = tab => ({
  type: SET_DEFAULT_TAB,
  tab,
});

export const handleProductComment = (comment, productKey) => ({
  type: HANDLE_PRODUCT_COMMENT,
  comment,
  productKey,
});

export const setPickUpTime = pickUpTime => ({
  type: SET_PICK_UP_TIME,
  pickUpTime,
});

export const setProductId = (productId, productKey) => ({
  type: SET_PRODUCT_ID,
  productId,
  productKey,
});

export const addSideToProduct = (sideIndex, sideId, productKey) => ({
  type: ADD_SIDE_TO_PRODUCT,
  sideIndex,
  sideId,
  productKey,
});

export const addBeverageToProduct = (beverageIndex, beverageId, productKey) => ({
  type: ADD_BEVERAGE_TO_PRODUCT,
  beverageIndex,
  beverageId,
  productKey,
});
