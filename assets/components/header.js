import React, {Component} from "react";
import {Navigation} from "./navigation";
import {CartCounter} from "./cartCounter";

export class Header extends Component {
    render() {
      return (
        <header>
          <div className='container_header'>
            <div className='block_header'>
              <img className='logo' src='/logo/logo.svg' alt=''/>

              <Navigation />

              <a className='cart'><img src='/logo/CArT (1).svg' alt=''/>
                {this.props.count > 0 && <CartCounter count={this.props.count} />}
              </a>

            </div>
          </div>
        </header>
      )
    }
}