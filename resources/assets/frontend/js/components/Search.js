import React, { Component } from 'react';
import Product from "./Product";

class Search extends Component {

    constructor(props) {
        super(props);

        this.state = {
            items: [],
            isLoaded : false,
            query: false
        };

        this.onSearch = this.onSearch.bind(this);
    }

    componentDidMount() {
        fetch(route('frontend.taxonomies.categories')).then(res => res.json()).then(
            (result) => {
                this.setState({
                    isLoaded: true,
                    items: result
                });
            },
            (error) => {
                this.setState({
                    isLoaded: true,
                    error
                });
            }
        )
    }

    onSearch(e){
        this.setState({
           query: e.target.value
        });
    }

    render() {
        const _this = this;
        const _products = [];

        this.state.items.map((category, i) => {
            category.products.map(item => (_products.push(item)));
        });

        const products = [];
        _products.forEach((item, index) => {
            if(_this.state.query && item.name.toLowerCase().search(_this.state.query.toLowerCase()) > -1){
                products.push(<Product key={index} product={item}/>);
            } else if(!_this.state.query){
                products.push(<Product key={index} product={item}/>);
            }
        });

        console.log(products)
        return (
            <section className="search-content">
                <div className="search-content-wrapper">
                    <div className="container">
                        <div className="row">
                            <div className="search-content-group">
                                <div className="search-content-inner">
                                    <div id="search">
                                        <div className="expanded-message">
                                            <div className="search-field">
                                                <form className="search" action="#" style={{position:'relative'}}>
                                                    <input type="hidden" name="type"/>
                                                    <button className="search-submit" type="submit">
                                                        <span className="cs-icon icon-search"></span>
                                                    </button>
                                                    <input type="text" name="q" className="search_box" placeholder="search our store" autoComplete="off" onChange={e => this.onSearch(e)}/>
                                                </form>
                                            </div>
                                            {this.state.query && <div>
                                                <span className="subtext">Your search for '<strong>{this.state.query}</strong>' revealed the following: </span>
                                                <span className="results">{products.length} results found</span>
                                            </div>}
                                        </div>
                                        <div className="product-item-group clearfix">
                                            {products}
                                        </div>
                                        <div className="search-bottom-toolbar">
                                            <div className="search-pagination col-sm-6"></div>
                                            <div className="search-counter col-sm-6">
                                                Items 1 to {products.length} of {_products.length} total
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

export default Search;