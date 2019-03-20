import React from 'react';

/* global trans */
const WelcomeHeader = () => (
  <section className="home-welcome-layout zoomIn animated" data-animate="zoomIn" data-delay="200">
    <div className="container">
      <div className="row">
        <div className="home-welcome-inner">
          <div className="home-welcome-content text-center">
            <span className="welcome-caption">
              {trans('frontend.homepage.header_message')}
              <br />
              {trans('frontend.homepage.header_message_copy')}
              <br />
              <a href="#start-order" className="btn btn-danger">
                {trans('frontend.homepage.click_to_action')}
              </a>
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
