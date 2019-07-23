import React from 'react';

const ConfigurationContext = React.createContext({});

export const ConfigurationProvider = ConfigurationContext.Provider;
export const ConfigurationConsumer = ConfigurationContext.Consumer;
