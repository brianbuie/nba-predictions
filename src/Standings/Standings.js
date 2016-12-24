import React, { Component } from 'react';
import Ticker from '../Ticker/Ticker';
import './Standings.css';

class Standings extends Component {

	render() {
		return (
			<div className="col-md-6">
				<div className="table-responsive">
					<table className="table table-sm standings-table spaced-out-md">
						<thead>
							<tr>
								<th className="txt-center" style={{ width: "10%" }}> Rank </th>
								<th style={{ width: "10%" }}></th>
								<th className="txt-capitalize">{ this.props.conference }</th>
								<th className="txt-center" style={{ width: "20%" }}> Record </th>
								<th style={{ width: "10%" }}></th>
							</tr>
						</thead>
						<tbody>
							{ this.renderTeams() }
						</tbody>
					</table>
				</div>
			</div>
		);
	}

	renderTeams(){
		let teams = this.props.standings.filter( team => {
			return team.CONFERENCE === this.props.conference;
		}).map((team, i) => {
			let className = i > 7 ? "txt-faded" : "";
			if(team.difference.RANK < 0){ className += " bkg-positive"; }
			if(team.difference.RANK > 0){ className += " bkg-negative"; }
			return (
				<tr className={ className } key={ team.ABRV }>
					<td className="txt-center">
						{ team.RANK }
					</td>
					<td className="txt-center">
						<Ticker value={ team.difference.RANK } inverted={ true }/>
					</td>
					<td>
						{ team.TEAM }
					</td>
					<td className="txt-center">
						{ team.W }-{ team.L }
					</td>
					<td className="txt-center">
						{ this.winOrLoss(team.difference) }
					</td>
				</tr>
			);
		});
		return teams;
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

export default Standings;