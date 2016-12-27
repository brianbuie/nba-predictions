// dependencies
import Api from '../Api/Api';
import Layout from '../Layout/Layout';
import Loading from '../Loading/Loading';
import Moment from 'moment';
import React, { Component } from 'react';
// css
import './App.css';

class App extends Component {

	constructor(props){
		super(props);
		this.state = {};
	}

	componentWillMount(){
		this.fetchInitialState();
		this.fetchCompleteScoreHistory();
		this.fetchTeamStandingsHistory("West");
	}

	fetchInitialState(){
		this.setState({ loading: true });
		Api.get( '?type=compare', (data) => { 
			this.setState( data[0] );
			let teams = this.state.standings.filter( team => { return team.CONFERENCE === "West" });
			let activeTeam = teams[0].ABRV;
			this.setState({
				activeUsername: this.state.users[0].name,
				userColors: this.calculateColors(this.state.users, 'name', this.state.users[0].name),
				activeConference: "West",
				activeTeam: activeTeam,
				teamColors: this.calculateColors(teams, 'ABRV', activeTeam),
				loading: false
			});
		});
	}

	render() {
		return (
			<div>
				{ this.state.loading ? <Loading /> : null }
				{ this.state.activeUsername ? 
					<Layout 
						{ ...this.state } 
						handleDateChange={ (delta) => { this.handleDateChange(delta) } }
						handleTeamChange={ (abrv) => { this.handleTeamChange(abrv) }}
						handleConferenceChange={ (conference) => { this.handleConferenceChange(conference) }}
						handleUserSelect={ (username) => {this.handleUserSelect(username)} }
					/> 
				: null }
			</div>
		);
	}

	handleDateChange(delta){
		this.setState({ loading: true });
		let date = new Moment(this.state.date).add(delta, 'days');
		Api.get('?type=compare&date=' + date.format('YYYY-MM-DD'), (data) => { 
			this.setState( data[0] );
			this.setState({ loading: false });
		});
	}

	fetchCompleteScoreHistory(){
		Api.get( '?type=userscores&days=1000', (data) => {
			this.setState({ allScores: data });
		});
	}
	
	fetchTeamStandingsHistory(conference){
		let allRecords = this.state.allRecords ? this.state.allRecords : {};
		if(!allRecords.hasOwnProperty(conference)){
			Api.get( '?type=teamrecords&days=1000&include=' + conference, (data) => {
				allRecords[conference] = data;
				this.setState({ allRecords: allRecords });
			});
		}
	}

	handleUserSelect(username){
		this.setState({ 
			activeUsername: username,
			userColors: this.calculateColors(this.state.users, 'name', username)
		});
	}

	handleConferenceChange(conference){
		let teams = this.state.standings.filter( team => { return team.CONFERENCE === conference })
		let activeTeam = teams[0].ABRV;
		this.setState({ 
			activeConference: conference,
			activeTeam: activeTeam,
			teamColors: this.calculateColors(teams, 'ABRV', activeTeam),
		});
		if(!this.state.allRecords[conference]){
			this.fetchTeamStandingsHistory(conference);
		}
	}

	handleTeamChange(abrv){
		let teams = this.state.standings.filter( team => { return team.CONFERENCE === this.state.activeConference })
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

export default App;
