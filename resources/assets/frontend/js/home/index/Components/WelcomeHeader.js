import React from 'react';
import { ConfigurationConsumer } from '../Context/Configuration';

const WelcomeHeader = () => (
  <ConfigurationConsumer>
    {({ imageHeader, welcomeText }) => (
      <section className="home-welcome-layout zoomIn animated" data-animate="zoomIn" data-delay="200">
        <div className="container">
          <div className="row">
            <div className="home-welcome-inner">
              <div className="home-welcome-content text-center">
                <span className="welcome-caption">
                  {welcomeText}
                  <br />
                  <a href="#start-order" className="btn btn-danger">
                    {trans('frontend.homepage.click_to_action')}
                  </a>
                  <br />
                </span>
                <img className="welcome-banner" src={imageHeader} alt="Cantinapp" />
              </div>
            </div>
          </div>
        </div>
      </section>
    )}
  </ConfigurationConsumer>
);

export default WelcomeHeader;
