import React, {Component} from "react";
import axios from "axios";
import {Header} from "../components/header";
import {CartPage} from "./CartPage";
import {ShopPage} from "./ShopPage";

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

  //onDeleteCallback
  deleteProductById(productId, functionUpdate) {
    axios.delete(`/api/cart/${productId}`)
      .then(() => {
      axios.get('/api/cart')
        .then(() => {
          functionUpdate();
        })
    })
  }


  render() {
    return(
      <div className='wrapper'>
        <Header count={this.state.cartProductCount}/>

        <CartPage onDeleteProduct={(productId, functionUpdate) => this.deleteProductById(productId, functionUpdate)}/>
      </div>
    )
  }

  // render() {
  //   return(
  //     <div className='wrapper'>
  //       <Header count={this.state.cartProductCount}/>
  //
  //       <ShopPage onProductAddedToCart={(idProduct) => this.addProductToCart(idProduct)}/>
  //     </div>
  //   )
  // }
}
