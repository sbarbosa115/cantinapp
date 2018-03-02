import React, { Component } from 'react';

export default class Product extends Component {

    constructor(props) {
        super(props);

        this.state = {
            product: props.product,
        };
    }

    addToOrder(e, product) {
        e.preventDefault();

        fetch("order/add/" + product).then((res) => {
            return res.text();
        }).then((data) => {
            $("#modal-messages").html(data).modal();
        });
    }

    render() {
        return (
            <div className="content_product col-sm-3 fadeInUp animated" data-animate="fadeInUp" data-delay="100">
                <div className="row-container product list-unstyled clearfix product-circle">
                    <div className="row-left">
                        <a href="./product.html" className="hoverBorder container_item">
                            <div className="hoverBorderWrapper">
                                <img src={this.state.product.image_path} className="img-responsive front"/>
                                <div className="mask"></div>
                            </div>
                        </a>
                        <div className="hover-mask">
                            <div className="group-mask">
                                <div className="inner-mask">
                                    <div className="group-actionbutton">
                                        <ul className="quickview-wishlist-wrapper">
                                            <li className="wishlist">
                                                <a title="Add To Wishlist" className="wishlist wishlist-juice-ice-tea" data-wishlisthandle="juice-ice-tea">
                                                    <span className="cs-icon icon-heart"></span>
                                                </a>
                                            </li>
                                            <li className="quickview hidden-xs hidden-sm">
                                                <div className="product-ajax-cart">
                                                    <span className="overlay_mask"></span>
                                                    <div data-handle="juice-ice-tea" data-target="#quick-shop-modal" className="quick_shop" data-toggle="modal">
                                                        <a>
                                                            <span className="cs-icon icon-eye"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                            <li className="compare">
                                                <a title="Add To Compare" className="compare compare-juice-ice-tea" data-comparehandle="juice-ice-tea">
                                                    <span className="cs-icon icon-retweet2"></span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <form action="./cart.html" method="post">
                                        <div className="effect-ajax-cart">
                                            <input name="quantity" value="1" type="hidden"/>
                                            <button className="_btn add-to-cart" data-parent=".parent-fly" onClick={(e) => this.addToOrder(e, this.state.product.id)} title="Add To Order">Add to Order</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div className="product-label">
                            <div className="label-element new-label">
                                <span>New</span>
                            </div>
                        </div>
                    </div>
                    <div className="row-right animMix">
                        <div className="rating-star">
                            <span className="spr-badge" data-rating="0.0">
                                <span className="spr-starrating spr-badge-starrating">
                                    <i className="spr-icon spr-icon-star-empty"></i>
                                    <i className="spr-icon spr-icon-star-empty"></i>
                                    <i className="spr-icon spr-icon-star-empty"></i>
                                    <i className="spr-icon spr-icon-star-empty"></i>
                                    <i className="spr-icon spr-icon-star-empty"></i>
                                </span>
                                <span className="spr-badge-caption">No reviews</span>
                            </span>
                        </div>
                        <div className="product-title">
                            <a className="title-5" href="./product.html">{this.state.product.name}</a>
                        </div>
                        <div className="product-price">
                            <span className="price">
                                <span className="money" data-currency-usd={this.state.product.name}>{this.state.product.currency}</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

