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
                                        Desde ahora vas a poder ordenar tus comidas favoritas con anticipación y recogerlas en el momento que mas te convenga utilizando nuestra nueva e ingeniosa aplicación.
                                        <br />
                                        No filas, no esperas, solo has tu selección y te notificaremos cuando tu pedido este listo.
                                        <br />
                                        EMPEZAMOS?
                                        <br />
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