import React, {Component} from "react";
import axios from "axios";
import {Header} from "../components/header";
import {ShopPage} from "./shopPage";

export class PageContainer extends Component {
  constructor(props) {
    super(props);

    this.state = {
      cartProductsCount: 0
    }
  }

  addProductToCart(idProduct) {
    axios.put('/api/cart', {
      product_id: idProduct,
      count: 1
    })
      .then(() => {
        return axios.get('/api/cart/count')
      })
      .then(response => {
        this.setState({
          cartProductCount: response.data.count
        });
      })
  }

  render() {
    return(
      <div className='wrapper'>
        <Header count={this.state.cartProductCount}/>

        <ShopPage onProductAddedToCart={(idProduct) => this.addProductToCart(idProduct)}/>
      </div>
    )
  }
}
