import React, {Component} from "react";
import {PopUp} from "./popUp";

export class ProductCard extends Component {
  render() {
    return(
      <div className="card" data-id={this.props.id}>
        <img className="img" src={this.props.image_path} alt=""/>
          <h1 className="title">{this.props.name}</h1>

          <div className="footer_card">
            <p className="price">{this.props.price} ₽</p>
            <button className="button" onClick={() => this.props.onClickB(Number(this.props.id))}>
              <img src="/logo/button.svg" alt=""/>
            </button>
          </div>
      </div>
    )
  }
}
