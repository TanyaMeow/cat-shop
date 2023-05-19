import React, {Component} from "react";
import {CartTitle} from "../components/cartTitle";
import axios from "axios";
import {ProductInCart} from "../components/productInCart";
import {TotalPrice} from "../components/TotalPrice";

export class CartPage extends Component {
  cartValues() {
    axios.get('/api/cart')
      .then(response => {
        this.setState(response.data);
      })
    axios.get('/api/cart/total')
      .then(response => {
        this.setState(response.data);
      })
  }

  componentDidMount() {
    this.cartValues();
  }

  constructor(props) {
    super(props);

    this.state = {
      products: [],
      total: 0,
    };
  }

  render() {
    return (
      <div className="cart_container">
        <div className="cart_block">
          <div className="cart_frame">

            <CartTitle />

            {this.state.products.map(product => (
              <ProductInCart id={product.id}
                             image_path={product.image_path}
                             name={product.name}
                             price={product.price}
                             count={product.count}
                             key={product.id}
                             functionUpdate={() => this.cartValues()}
              />
              ))}

            <TotalPrice total={this.state.total}/>

          </div>
        </div>
      </div>
    )
  }
}
