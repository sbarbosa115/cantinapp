import PropTypes from 'prop-types';

const OrderProtoType = {
  id: PropTypes.number.isRequired,
  name: PropTypes.string.isRequired,
  created_date: PropTypes.string.isRequired,
  total_products: PropTypes.number.isRequired,
  status: PropTypes.string.isRequired,
  actions: PropTypes.shape({
    duplicate_order: PropTypes.string.isRequired,
  }),
};


export default OrderProtoType;
