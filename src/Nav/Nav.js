import React, { Component } from 'react';
import FontAwesome from 'react-fontawesome';

import './Nav.css';

class Nav extends Component {

	render() {
		return (
			<nav>
				<div className="nav-link-container">
					{ this.arrow('left', this.props.prevLink) }
				</div>
				<h4 className="title">
					{ this.props.title }
				</h4>
				<div className="nav-link-container">
					{ this.arrow('right', this.props.nextLink) }
				</div>
			</nav>
		);
	}

	arrow(direction, action) {
		if(action){
			return (
				<a className={"nav-link nav-" + direction } onClick={ action } href="">
					<FontAwesome name={"arrow-" + direction } />
				</a>
			);
		}
	}
}

export default Nav;