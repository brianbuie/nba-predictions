import React, { Component } from 'react';
import FontAwesome from 'react-fontawesome';

import './Nav.css';

class Nav extends Component {

	render() {
		return (
			<nav>
				<div className="nav-link-container">
					{ this.arrow('left', this.props.leftLink) }
				</div>
				<h4 className="title txt-center">
					{ this.props.title }
				</h4>
				<div className="nav-link-container">
					{ this.arrow('right', this.props.rightLink) }
				</div>
			</nav>
		);
	}

	arrow(direction, href) {
		if(href){
			return (
				<a className={"nav-link nav-" + direction } href={ href }>
					<FontAwesome name={"arrow-" + direction } />
				</a>
			);
		}
	}
}

export default Nav;