import React, { Component } from 'react';
import Ticker from '../Ticker/Ticker';
import './StandingsTable.css';

class StandingsTable extends Component {

	render() {
		return (
			<div>
				<div className="conference-select-container">
					<div 
						className={ (this.props.activeConference === "West" ? "active" : null) + " conference-select" }
						onClick={ () => { this.props.handleConferenceChange('West') }}
					>
						West
					</div>
					<div 
						className={ (this.props.activeConference === "East" ? "active" : null) + " conference-select" }
						onClick={ () => { this.props.handleConferenceChange('East') }}
					>
						East
					</div>
				</div>
				<div className="table-responsive">
					<table className="table table-sm standings-table">
						<thead></thead>
						<tbody>
							{ this.props.standings.filter( team => {
								return team.CONFERENCE === this.props.activeConference;
							}).map((team, i) => {
								let className = i > 7 ? "txt-faded" : "";
								return (
									<tr 
										className={ className }
										key={ team.ABRV }
										style={
											team.ABRV === this.props.activeTeam ? 
												{ borderRight: "4px solid " + this.props.teamColors[team.ABRV]} : 
												{ borderRight: "4px solid transparent" }
										}
										onClick={ () => { this.props.handleTeamChange(team.ABRV) }}
									>
										<td className="txt-center">
											<Ticker value={ team.difference.RANK } inverted={ true }/>
										</td>
										<td>
											{ team.ABRV }
										</td>
										<td>
											{ team.W }-{ team.L }
										</td>
										<td className="txt-center">
											{ this.winOrLoss(team.difference) }
										</td>
									</tr>
								);
							}) }
						</tbody>
					</table>
				</div>
			</div>
		);
	}

	winOrLoss(difference){
		if( difference.G === 0 ){ return }
		let className = difference.W > difference.L ? "txt-positive" : "";
		className = difference.L > difference.W ? "txt-negative" : className;
		let text = "";
		if( difference.G === 1 ){
			if(difference.W > 0){ text = "W"; }
			if(difference.L > 0){ text = "L"; }
		}
		if( difference.G > 1 ){
			text = "(" + difference.W + "-" + difference.L + ")";
		}
		return( <span className={ className }>{ text }</span> );
	}
}

export default StandingsTable;