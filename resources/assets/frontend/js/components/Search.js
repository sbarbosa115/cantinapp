import React, { Component } from 'react';

export default class Search extends Component {

    constructor(props) {
        super(props);

        this.state = {
            product: props.product,
        };
    }

    addToOrder(e, product) {
        e.preventDefault();

        fetch("order/add/" + product).then((res) => {
            return res.text();
        }).then((data) => {
            $("#modal-messages").html(data).modal();
        });
    }

    render() {
        return (
            <div></div>
        );
    }
}

