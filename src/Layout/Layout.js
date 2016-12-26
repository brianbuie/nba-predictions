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
		let teams = props.standings.filter( team => { return team.CONFERENCE === "West" });
		let activeTeam = teams[0].ABRV;
		this.state = {
			activeUsername: props.users[0].name,
			userColors: this.calculateColors(props.users, 'name', props.users[0].name),
			activeConference: "West",
			activeTeam: activeTeam,
			teamColors: this.calculateColors(teams, 'ABRV', activeTeam)
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
						<Standings 
							{ ...this.props } 
							{ ...this.state } 
							handleTeamChange={ (abrv) => { this.handleTeamChange(abrv) }}
							handleConferenceChange={ (conference) => { this.handleConferenceChange(conference) }}
						/>
					</div>
					<ImageSelect { ...this.props } />
				</div>
			</div>
		);
	}

	handleUserSelect(username){
		this.setState({ 
			activeUsername: username,
			userColors: this.calculateColors(this.props.users, 'name', username)
		});
	}

	handleConferenceChange(conference){
		let teams = this.props.standings.filter( team => { return team.CONFERENCE === conference })
		let activeTeam = teams[0].ABRV;
		this.setState({ 
			activeConference: conference,
			activeTeam: activeTeam,
			teamColors: this.calculateColors(teams, 'ABRV', activeTeam)
		});
	}

	handleTeamChange(abrv){
		let teams = this.props.standings.filter( team => { return team.CONFERENCE === this.state.activeConference })
		this.setState({
			activeTeam: abrv,
			teamColors: this.calculateColors(teams, 'ABRV', abrv)
		})
	}

	calculateColors(things, nameProperty, activeThingName){
		const alphaIncrement = .9 / things.length;
		const baseColor = "rgba(62, 93, 144, ";
		let colors = {};
		things.map( (thing, i) => {
			let alpha = 1 - (alphaIncrement * i);
			colors[thing[nameProperty]] = baseColor + alpha + ")";
			return null;
		});
		colors[activeThingName] = "rgba(255, 130, 46, 1)";
		return colors;
	}
}

export default Layout;