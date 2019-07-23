import uuid from 'uuid/v4';

const Product = (productId = null) => ({
  id: uuid(),
  product_id: productId,
  sides: [],
  beverages: [],
  comment: '',
});

export default Product;
