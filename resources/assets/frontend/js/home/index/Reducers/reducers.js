import { combineReducers } from 'redux';
import modals from './modal';
import order from './order';

const initReducers = combineReducers({
  order, modals,
});

export default initReducers;
