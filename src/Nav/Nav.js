import FontAwesome from 'react-fontawesome';
import Moment from 'moment';
import React, { Component } from 'react';

import './Nav.css';

class Nav extends Component {

	render() {
		return (
			<nav>
				<div className="nav-link-container">
					{ this.arrow('left', () => {this.props.dateChange(-1)}) }
				</div>
				<h4 className="title">
					{ this.title() }
				</h4>
				<div className="nav-link-container">
					{ this.arrow('right', () => {this.props.dateChange(1)}) }
				</div>
			</nav>
		);
	}

	title(){
		let title = new Moment(this.props.date);
		return title.format('MMMM D, YYYY');
	}

	arrow(direction, action) {
		if(action){
			return (
				<a className={"nav-link nav-" + direction } onClick={ action }>
					<FontAwesome name={"arrow-" + direction } />
				</a>
			);
		}
	}
}

export default Nav;