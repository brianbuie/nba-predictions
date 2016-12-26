// dependencies
import ImageSelect from '../ImageSelect/ImageSelect';
import Nav from '../Nav/Nav';
import Picks from '../Picks/Picks';
import React, { Component } from 'react';
import Scoreboard from '../Scoreboard/Scoreboard';
import ScoreGraph from '../ScoreGraph/ScoreGraph';
import Standings from '../Standings/Standings';
// css
import './Layout.css';

class Layout extends Component {

	constructor(props){
		super(props);
		this.state = {
			activeUsername: props.users[0].name,
			userColors: this.calculateUserColors(props.users[0].name)
		}
	}

	render() {
		return (
			<div>
				<Nav { ...this.props }/>
				<div className="container">
					{ this.props.allScores ? <ScoreGraph { ...this.props } { ...this.state } /> : null }
					<Scoreboard users={ this.props.users } { ...this.state } handleUserSelect={ (username) => {this.handleUserSelect(username)} }/>
					<Picks 
						user={ this.props.users.filter( user => {return user.name === this.state.activeUsername})[0] } 
						standings={ this.props.standings } 
					/>
					<div className="row">
						<h3 className="spaced-out-lg">NBA Standings</h3>
						<Standings
							conference="West"
							standings={ this.props.standings }
						/>
						<Standings
							conference="East"
							standings={ this.props.standings }
						/>
					</div>
					<ImageSelect {...this.props} />
				</div>
			</div>
		);
	}

	handleUserSelect(username){
		this.setState({activeUsername: username});
		this.setState({userColors: this.calculateUserColors(username) });
	}

	calculateUserColors(activeUsername){
		const alphaIncrement = .9 / this.props.users.length;
		const baseColor = "rgba(62, 93, 144, ";
		let userColors = {};
		this.props.users.map( (user, i) => {
			let alpha = 1 - (alphaIncrement * i);
			userColors[user.name] = baseColor + alpha + ")";
			return null;
		});
		userColors[activeUsername] = "rgba(255, 130, 46, 1)";
		return userColors;
	}
}

export default Layout;