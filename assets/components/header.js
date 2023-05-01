import React, {Component} from "react";
import {Navigation} from "./navigation";

export class Header extends Component {
    render() {
      return (
        <header>
          <div className='container_header'>
            <div className='block_header'>
              <img className='logo' src='/logo/logo.svg' alt=''/>

              <Navigation />

              <a className='cart'><img src='/logo/CArT (1).svg' alt=''/>
                {/*<div className='log'>*/}
                {/*  <img className='paw' src='/logo/paw.svg' alt=''/>*/}
                {/*</div>*/}
              </a>
            </div>
          </div>
        </header>
      )
    }
}
