import React, {Component} from "react";
import axios from "axios";
import {Header} from "../components/header";
import {ShopPage} from "./shopPage";

export class ContainerPage extends Component {
  constructor(props) {
    super(props);

    this.state = {
      cartProductCount: 0
    }
  }

  setCartCount(id) {
    axios.put('/api/cart', {
      product_id: id,
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

        <ShopPage onClickButton={(id) => this.setCartCount(id)}/>
      </div>
    )
  }
}
