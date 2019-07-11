import ReactDOM from 'react-dom';
import React from 'react';
import { ApolloProvider } from 'react-apollo';
import ApolloClient from 'apollo-boost';
import OrderHandler from './index/Components/OrderHandler';


/* global document */
const container = document.getElementById('index-products');
const signedId = JSON.parse(container.dataset.signedIn);

const client = new ApolloClient({
  uri: 'http://demo.cantinapp.local/graphql',
});

ReactDOM.render(
  <ApolloProvider client={client}>
    <OrderHandler
      signedIn={signedId}
    />
  </ApolloProvider>, container,
);
