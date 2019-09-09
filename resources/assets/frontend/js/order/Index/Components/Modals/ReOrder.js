import React, { useState } from 'react';
import Modal from 'react-bootstrap-modal';
import PropTypes from 'prop-types';
import moment from 'moment';
import DateTimePicker from 'react-widgets/lib/DateTimePicker';
import roundedUp from '../../../../home/Utils/DateUtils';
import OrderProtoType from '../../Model/Order';

const ReOrder = ({ closeReOrderModal, order }) => {
  const [pickUpTime, setPickUpTime] = useState(null);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(false);
  return (
    <Modal
      show
      onHide={() => {
        closeReOrderModal();
      }}
    >
      <Modal.Header closeButton>
        <Modal.Title id="ModalHeader">
          { trans('frontend.orders.duplicate_order') }
        </Modal.Title>
      </Modal.Header>
      <Modal.Body>
        {!error && (
          <div className="form-group">
            { trans('frontend.orders.pickup_time') }
            <DateTimePicker
              min={moment().minute(roundedUp).second(0).toDate()}
              date={false}
              step={15}
              onChange={(value) => {
                setPickUpTime(moment(value).format('HH:mm'));
              }}
              defaultValue={pickUpTime}
            />
          </div>
        )}
        {error && <h1>{error}</h1>}
        <div className="form-group">
          <button
            type="button"
            className="btn btn-success btn-lg btn-block"
            onClick={() => {
              const token = window.document.head.querySelector('meta[name="csrf-token"]');
              setLoading(true);
              fetch(order.actions.duplicate_order, {
                headers: {
                  'Content-Type': 'application/json',
                  Accept: 'application/json',
                  'X-Requested-With': 'XMLHttpRequest',
                  'X-CSRF-Token': token.content,
                },
                method: 'post',
                body: JSON.stringify({
                  pickup_at: pickUpTime,
                }),
              }).then(response => response.json())
                .then((body) => {
                  if (body.exception) {
                    setError(body.message);
                  } else {
                    window.location.reload();
                  }
                });
            }}
            disabled={pickUpTime === null || error}
          >
            {loading && <i className="fa fa-spinner fa-spin" />}
            &nbsp;
            {trans('frontend.orders.create_order')}
          </button>
        </div>
        <div className="clearfix" />
      </Modal.Body>
    </Modal>
  );
};

ReOrder.propTypes = {
  closeReOrderModal: PropTypes.func,
  order: PropTypes.shape(OrderProtoType).isRequired,
};

ReOrder.defaultProps = {
  closeReOrderModal: () => (''),
};

export default ReOrder;
