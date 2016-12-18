// dependencies
import icon from './icon.svg';
import React, { Component } from 'react';
// css
import './Loading.css';

class Loading extends Component {

	render() {
		return (
			<div className="loading">
				<img src={icon} className="icon fast-spin" role="presentation" />
			</div>
		);
	}

}

export default Loading;