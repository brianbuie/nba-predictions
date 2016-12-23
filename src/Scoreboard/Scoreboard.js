import React, { Component } from 'react';
import Ticker from '../Ticker/Ticker';
// import FontAwesome from 'react-fontawesome';

import './Scoreboard.css';

class Scoreboard extends Component {

	render() {
		return (
			<div className="row no-padding-bottom">
				{ this.renderUsers() }
			</div>
		);
	}

	renderUsers() {
		let users = this.props.users.map((user, i) => {
			return (
				<div 
					className="col-xs-3"
					key={user.name + "-score"} 
					onClick={ () => { this.props.handleUserSelect(user.name) }}
				>
					<div className={ this.props.activeUser.name === user.name ? "user-container active" : "user-container" }>
						<div className="user-image">
							{ this.renderImage(user.img) }
						</div>
						<h5 className="txt-capitalize txt-faded txt-center">
							{ user.name }
						</h5>
						<h1 className="txt-positive txt-center spaced-out-sm">
							{ user.score }
						</h1>
						<p className="txt-center">
							<Ticker value={ user.difference.score } />
						</p>
					</div>
				</div>
			);
		});
		return users;
	}

	renderImage(img){
		return img ? <img src={ img } alt="profile" /> : null;
	}
}

export default Scoreboard;