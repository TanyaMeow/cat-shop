import React, {Component} from "react";
import axios from "axios";
import {ProductCard} from "../components/productCard";

export class ShopPage extends Component {
  componentDidMount() {
    axios.get('/api/products')
      .then(response => {
        this.setState(response.data);
      })
  }

  constructor(props) {
    super(props);

    this.state = {
      products: []
    };
  }

  render() {
    return(

        <div className='shop_container'>
          <div className='shop_block'>
            {this.state.products.map(product => (
              <ProductCard id={product.id}
                           image_path={product.image_path}
                           name={product.name}
                           price={product.price}
                           key={product.id}
                           onClickB={this.props.onClickButton}
              />
            ))}

          </div>
        </div>
    )
  }
}
