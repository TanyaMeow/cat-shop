import React, {Component} from "react";
import axios from "axios";
import {CountContext} from '../Contexts/CountContext.js';
import {DeleteContext} from '../Contexts/DeleteContext.js';
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

  updateCount() {
    axios.get('/api/cart/count')
      .then((response) => {
        this.setState({
          cartProductsCount: response.data.count
        });
      })
  }

  componentDidMount() {
    this.updateCount();
  }

  addProductToCart(idProduct) {
    axios.put('/api/cart', {
      product_id: idProduct,
      count: 1
    })
      .then(() => {
        this.updateCount();
      });
  }

  //onDeleteCallback
  deleteProductById(productId, functionUpdate) {
    axios.delete(`/api/cart/${productId}`)
      .then(() => {
        axios.get('/api/cart')
          .then(() => {
            functionUpdate();
            this.updateCount();
          })
      })
  }


  render() {
    return (
      <div className='wrapper'>
        <CountContext.Provider value={this.state.cartProductsCount}>
          <Header/>

          <DeleteContext.Provider value={(productId, functionUpdate) => this.deleteProductById(productId, functionUpdate)}>
            <CartPage />
          </DeleteContext.Provider>
        </CountContext.Provider>
      </div>
    )
  }
}

//   render() {
//     return(
//       <div className='wrapper'>
//         <CountContext.Provider value={this.state.cartProductsCount}>
//           <Header/>
//         </CountContext.Provider>
//           <ShopPage onProductAddedToCart={(idProduct) => this.addProductToCart(idProduct)}/>
//       </div>
//     )
//   }
// }
