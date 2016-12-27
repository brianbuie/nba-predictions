import React, { Component } from 'react';
import Ticker from '../Ticker/Ticker';
import './UserCard.css';

class UserCard extends Component {

	render() {
		let user = this.props.user
		let isActiveUser = this.props.activeUsername === user.name ? true : false;
		return (
			<div 
				className={ isActiveUser ? "user-container active" : "user-container" }
				onClick={() => { this.props.handleUserSelect(user.name) }}
			>
				<div style={{ borderTop: "7px solid " + this.props.userColors[user.name] }}>
					<div
						className="user-image"
						style={{ 
							transform: isActiveUser ? "scale(1.1)" : "",
							backgroundImage: user.img ? 'url(' + user.img + ')' : null
						}}
					>
					</div>
					<h5 className={ isActiveUser ? "txt-capitalize txt-center" : "txt-capitalize txt-faded txt-center" }>
						{user.name}
					</h5>
					<h1 className="txt-positive txt-center spaced-out-sm">
						{user.score}
					</h1>
					<p className="txt-center">
						<Ticker value={user.difference.score} />
					</p>
				</div>
			</div>
		)
	}
}

export default UserCard;