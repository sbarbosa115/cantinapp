import moment from 'moment';

const roundedUp = Math.ceil(moment().minute() / 15) * 15;

export default roundedUp;
