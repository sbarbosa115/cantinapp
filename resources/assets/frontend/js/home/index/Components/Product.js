import React, { useState } from 'react';
import PropTypes from 'prop-types';
import momentLocalizer from 'react-widgets-moment';
import moment from 'moment';
import 'react-tabs/style/react-tabs.css';
import 'animate.css';
import { ConfigurationConsumer } from '../Context/Configuration';
import MoreInfoProduct from './Modals/MoreInfoProduct';

moment.locale('en');
momentLocalizer();

const Product = ({ product, modalAddProductHandlerToOrder }) => {
  const [showMoreInfoModal, setShowMoreInfoModal] = useState(false);
  return (
    <ConfigurationConsumer>
      {({ signedIn, pathLogin, allowOrders }) => (
        <div className="content_product col-sm-3 fadeInUp animated" data-animate="fadeInUp" data-delay="100">
          <div className="row-container product list-unstyled clearfix product-circle">
            <div className="row-left">
              <div className="hoverBorderWrapper">
                <img src={product.image_path} className="img-responsive front" alt={product.name} />
                <div className="mask" />
              </div>
              <div>
                <div className="group-mask">
                  <div className="inner-mask">
                    <form action="#" method="post">
                      <div className="effect-ajax-cart">
                        { signedIn && (
                          <button
                            type="button"
                            className="_btn add-to-cart"
                            data-parent=".parent-fly"
                            onClick={() => modalAddProductHandlerToOrder(product)}
                            title={trans('frontend.homepage.add_to_order')}
                            disabled={!allowOrders}
                          >
                            {trans('frontend.homepage.add_to_order')}
                          </button>
                        )}
                        { (allowOrders && !signedIn) && (
                          <a
                            href={pathLogin}
                            className="_btn add-to-cart"
                          >
                            {trans('frontend.homepage.add_to_order')}
                          </a>
                        )}
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <div className="product-label">
                <div className="label-element new-label">
                  <button
                    type="button"
                    className="more-info"
                    title={trans('more_info')}
                    onClick={() => {
                      setShowMoreInfoModal(product);
                    }}
                  >
                    <i className="fas fa-info-circle" />
                  </button>
                </div>
              </div>
            </div>
            <div className="row-right animMix">
              <div className="product-title">
                <span>{ product.name }</span>
              </div>
            </div>
          </div>
          {showMoreInfoModal && (
            <MoreInfoProduct closeHandler={setShowMoreInfoModal} product={product} />
          )}
        </div>
      )}
    </ConfigurationConsumer>
  );
};

export default Product;

Product.propTypes = {
  product: PropTypes.shape({
    name: PropTypes.string.isRequired,
    image_path: PropTypes.string.isRequired,
  }).isRequired,
  modalAddProductHandlerToOrder: PropTypes.func.isRequired,
};
