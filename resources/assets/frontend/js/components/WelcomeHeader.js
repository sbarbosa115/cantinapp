import React from 'react';

const WelcomeHeader = () => (
  <section className="home-welcome-layout zoomIn animated" data-animate="zoomIn" data-delay="200">
    <div className="container">
      <div className="row">
        <div className="home-welcome-inner">
          <h2 className="page-title">Welcome to Cantinapp!</h2>
          <div className="home-welcome-content text-center">
            <span className="welcome-caption">
              Desde ahora vas a poder ordenar tus comidas favoritas
              con anticipación y recogerlas en el momento que mas te convenga.
              <br />
                No filas, no esperas, solo has tu selección y te notificaremos
                cuando tu pedido este listo.
              <br />
              <a href="#start-order" className="btn btn-danger">¿EMPEZAMOS?</a>
              <br />
            </span>
            <img className="welcome-banner" src="images/header.jpg" alt="Cantinapp" />
          </div>
        </div>
      </div>
    </div>
  </section>
);

export default WelcomeHeader;
