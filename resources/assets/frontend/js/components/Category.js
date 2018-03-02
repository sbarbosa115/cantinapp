import React, { Component } from 'react';
import Product from "./Product";

export default class Category extends Component {

    constructor(props) {
        super(props);

        this.state = {
            items: [],
            isLoaded : false,
            styles : {
                backgroundImage : "url(http://via.placeholder.com/1170x182)"
            }
        };
    }

    componentDidMount() {
        fetch("/api/categories").then(res => res.json()).then(
            (result) => {
                this.setState({
                    isLoaded: true,
                    items: result
                });
            },
            // Note: it's important to handle errors here
            // instead of a catch() block so that we don't swallow
            // exceptions from actual bugs in components.
            (error) => {
                this.setState({
                    isLoaded: true,
                    error
                });
            }
        )
    }

    render() {
         var categories = this.state.items.map((category, index) =>
            (
                <div className="container" key={category.id}>
                    <div className="row">
                        <div className="banner-product-title fadeInUp animated" data-animate="fadeInUp" data-delay="200" style={this.state.styles}>
                            <div className="title-content">
                                <h2>{category.name}</h2>
                            </div>
                        </div>
                        <div className="home-product-inner">
                            <div className="home-product-content">
                                {category.products.map((product, index) =>
                                    <Product key={index} product={product}/>
                                )}
                            </div>
                        </div>
                    </div>
                </div>
            )
        , this);

        return (
            <div>{categories}</div>
        );
    }
};

