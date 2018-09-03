import React, { Component } from 'react';
import Product from "./Product";

class WelcomeHeader extends Component {

    constructor(props) {
        super(props);

        this.state = {
            imagePath : 'images/' + (Math.floor(Math.random() * 9) + 1) + '.jpg'
        }
    }

    render() {
        return (
            <section className="home-welcome-layout zoomIn animated" data-animate="zoomIn" data-delay="200">
                <div className="container">
                    <div className="row">
                        <div className="home-welcome-inner">
                            <h2 className="page-title">Welcome to Cantinapp!</h2>
                            <div className="home-welcome-content">
                                    <span className="welcome-caption">
                                        Aliquam dapibus tincidunt metus. Praesent justo dolor, lobortis quis, lobortis dignissim, pulvinar ac, lorem.
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Praesent vestibulum molestie lacus. Aenean nonummy hendrerit mauris. Phasellus porta. Fusce suscipit varius mi. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Fusce feugiat malesuada odio.
                                    </span>
                                    <img className="welcome-banner" src={this.state.imagePath} />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        );
    }
}

export default WelcomeHeader;