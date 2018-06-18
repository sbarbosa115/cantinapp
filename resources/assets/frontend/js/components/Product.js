import React, { Component } from 'react';

class Product extends Component {

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

    showProduct() {
        console.log('showing product')
    }

    render() {
        return (
            <div className="content_product col-sm-3 fadeInUp animated" data-animate="fadeInUp" data-delay="100">
                <div className="row-container product list-unstyled clearfix product-circle">
                    <div className="row-left">
                        <a onClick={this.showProduct()} className="hoverBorder container_item">
                            <div className="hoverBorderWrapper">
                                <img src={"/" + this.state.product.image_path} className="img-responsive front"/>
                                <div className="mask"></div>
                            </div>
                        </a>
                        <div className="hover-mask">
                            <div className="group-mask">
                                <div className="inner-mask">
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
                        <div className="product-title">
                            <a className="title-5" href="#">{this.state.product.name}</a>
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

export default Product;

