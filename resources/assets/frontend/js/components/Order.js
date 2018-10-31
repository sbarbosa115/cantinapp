import React, {Component} from 'react';
import moment from 'moment';
import momentLocalizer from 'react-widgets-moment';
import DateTimePicker from 'react-widgets/lib/DateTimePicker'

class Order extends Component {

  constructor(props) {
    super(props);
    this.state = {
      pickUpDate: null,
      errors: {}
    };

    this.sendOrder = this.sendOrder.bind(this);
    this.handleChange = this.handleChange.bind(this);
  }

  sendOrder() {
    const _this = this;
    axios({
      method: 'post',
      url: route('frontend.order.store'),
      data: {
        pickup_at: moment(this.state.pickUpDate).format('YYYY-MM-DD HH:mm:ss'),
        payment_method: 'cantina'
      }
    }).then(function (response) {
      if (response.data.errors) {
        console.log(response.data.errors);
        _this.setState({
          errors: response.data.errors
        });
      } else {
        window.location.href = response.data.redirect;
      }
    });
  };

  handleChange(date) {
    this.setState({
      pickUpDate: date
    });
  }

  render() {
    moment.locale('en');
    momentLocalizer();

    const products = this.props.order.map((item, key) => {
      const sides = item.orderProductSides.map((item2) => {
        return item2.name;
      });
      return (
        <tr className="odd" key={key}>
          <td className="td-product">
            <a href="#">{item.name}</a>
          </td>
          <td className="quantity text-center">1</td>
          <td className="money">
            <span className="money">1 Credit</span>
          </td>
          <td>
            {sides.join(',')}
          </td>
        </tr>
      );
    });
    const customer = this.props.customer;
    const roundedUp = Math.ceil(moment().minute() / 15) * 15;
    const errors = [];
    if (Object.keys(this.state.errors).length > 0) {
      for (const error in this.state.errors) {
        errors.push(this.state.errors[error][0]);
      }
      window.scrollTo(0, 0);
    }
    return (
      <div className="order-inner">
        {errors.length > 0 && <div className="alert alert-danger" role="alert">
          {errors.join('<br />')}
        </div>}

        <div className="order-content">
          <div className="order-id">
            <h2>Order #{moment().unix()}</h2>
            <span className="date">{moment().format('dddd, MMMM Do YYYY, h:mm:ss a')}</span>
          </div>
          <div className="order-address">
            <div id="order_payment" className="col-md-6 address-items">
              <h2 className="address-title">Billing Address</h2>
              <div className="address-content">
                <div className="address-item">
                  <span className="title">Payment Status:</span>
                  <span className="content">Pick Up Payment</span>
                </div>
                <div className="address-item name">
                  <span className="title">Your name:</span>
                  <span className="content">{customer.name}</span>
                </div>
                <div className="address-item">
                  <span className="title">Your email:</span>
                  <span className="content">{customer.email}</span>
                </div>
              </div>
            </div>
          </div>
          <div className="order-info">
            <div className="order-info-inner">
              <table id="order_details">
                <thead>
                <tr>
                  <th>Product</th>
                  <th className="text-center">Quantity</th>
                  <th>Price</th>
                  <th>Sides</th>
                </tr>
                </thead>
                <tbody>
                {products}
                </tbody>
              </table>
              <br/>
            </div>
          </div>
        </div>
        <div className="confirm-order">
          <p>When do would you like to pick up this order?</p>
          <DateTimePicker
            min={moment().minute(roundedUp).second(0).toDate()}
            max={moment().add(3, 'days').toDate()}
            step={15}
            onChange={value => this.setState({pickUpDate: value})}
          />
          <br/>
          <a className={`btn btn-success col-md-12 ${this.state.pickUpDate === null && 'disabled '}`}
             onClick={this.sendOrder}>Proceed to Order</a>
        </div>
      </div>
    );
  }
}

export default Order;