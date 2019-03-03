import React, {Component} from 'react';
import Product from "./Product";

class Category extends Component {

  constructor(props) {
    super(props);

    this.state = {
      items: [],
      isLoaded: false,
      styles: {
        backgroundImage: `url(images/${Math.floor((Math.random() + 1 * 9))}.jpg)`
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
      (error) => {
        this.setState({
          isLoaded: true,
          error
        });
      }
    )
  }

  render() {
    const categories = this.state.items.map((category) =>
        (
          <div className="container" key={category.id}>
            <div className="row">
              <div className="home-product-inner">
                <div className="home-product-content">
                  {category.products.map((product, index) =>
                    <Product key={index} product={product}/>
                  )}
                </div>
              </div>
              <div className="banner-product-title fadeInUp animated" data-animate="fadeInUp" data-delay="200"
                   style={this.state.styles}>
                <div className="title-content">
                  <h2>{category.name}</h2>
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
}

export default Category;