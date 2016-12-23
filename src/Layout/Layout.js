// dependencies
import Nav from '../Nav/Nav';
import Picks from '../Picks/Picks';
import React, { Component } from 'react';
import Scoreboard from '../Scoreboard/Scoreboard';
import Standings from '../Standings/Standings';
// css
import './Layout.css';

class Layout extends Component {

	constructor(props){
		super(props);
		this.state = {
			activeUsername: props.users[0].name
		}
	}

	render() {
		return (
			<div>
				<Nav {...this.props}/>
				<div className="container">
					<Scoreboard {...this.props} {...this.state} handleUserSelect={(username) => {this.handleUserSelect(username)}}/>
					<Picks 
						user={this.props.users.filter(user => {return user.name === this.state.activeUsername})[0]} 
						standings={this.props.standings} 
					/>
					<div className="row">
						<Standings
							conference="West"
							{...this.props}
						/>
						<Standings
							conference="East"
							{...this.props}
						/>
					</div>
				</div>
			</div>
		);
	}

	handleUserSelect(username){
		this.setState({activeUsername: username});
	}


}

export default Layout;