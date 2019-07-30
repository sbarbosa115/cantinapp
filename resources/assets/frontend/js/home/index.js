import ReactDOM from 'react-dom';
import React from 'react';
import { ApolloProvider } from 'react-apollo';
import ApolloClient from 'apollo-boost';
import OrderHandler from './index/Components/OrderHandler';


const container = document.getElementById('index-products');
const signedId = JSON.parse(container.dataset.signedIn);
const dataSource = container.dataset.dataProvider;
const {
  pathCreateOrder, pathLogin, imageError, imageSuccess, imageHeader,
} = container.dataset;

const client = new ApolloClient({ uri: dataSource });

ReactDOM.render(
  <ApolloProvider client={client}>
    <OrderHandler
      signedIn={signedId}
      pathLogin={pathLogin}
      pathCreateOrder={pathCreateOrder}
      imageSuccess={imageSuccess}
      imageError={imageError}
      imageHeader={imageHeader}
    />
  </ApolloProvider>, container,
);
