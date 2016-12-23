import FontAwesome from 'react-fontawesome';
import Moment from 'moment';
import React, { Component } from 'react';

import './Nav.css';

class Nav extends Component {

	render() {
		return (
			<nav>
				<div className="nav-link-container">
					<a className="nav-link nav-left" onClick={() => {this.props.dateChange(-1)}}>
						<FontAwesome name="arrow-left" />
					</a>
				</div>
				<h4 className="title">
					{this.title()}
				</h4>
				<div className="nav-link-container">
					<a className="nav-link nav-right" onClick={() => {this.props.dateChange(1)}}>
						<FontAwesome name="arrow-right" />
					</a>
				</div>
			</nav>
		);
	}

	title(){
		let title = new Moment(this.props.date);
		return title.format('MMMM D, YYYY');
	}
}

export default Nav;