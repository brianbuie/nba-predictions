import React, { Component } from 'react';
import Ticker from '../Ticker/Ticker';
import './UserTable.css';

class UserTable extends Component {

	render() {
		return (
			<div className="table-responsive picks-table">
				<table className="table table-sm spaced-out-md">
					<thead>
						<tr>
							<th colSpan="2" style={{ width: "20%" }}>{ this.props.conference }</th>
							<th colSpan="2" style={{ width: "30%" }}> Predicted </th>
							<th colSpan="2" style={{ width: "30%" }}> Current </th>
							<th colSpan="2" style={{ width: "20%" }}> Points </th>
						</tr>
					</thead>
					<tbody>
						{ this.props.users.filter( user => { 
							return user.name === this.props.activeUsername; 
						})[0].picks.filter( pick => {
							return pick.actual.CONFERENCE === this.props.conference;
						}).sort((a, b) => {
							if(a.rank < b.rank){ return -1; }
							if(a.rank > b.rank){ return 1; }
							return 0;
						}).map((pick, i) => {
							let className = pick.score.placement.correct < 1 ? "txt-faded" : "";
							if(pick.difference.placement.score >= 15){ className += " bkg-positive"; }
							if(pick.difference.placement.score <= -15){ className += " bkg-negative"; }
							return (
								<tr className={ className } key={ pick.actual.ABRV }>
									<td>
										{ pick.rank }
									</td>
									<td>
										{ pick.actual.ABRV }
									</td>
									<td className="border-left">
										{ pick.wins }-{ (82 - pick.wins) }
									</td>
									<td className="txt-italic">
										{ pick.score.w_pct.predicted }
									</td>
									<td className="border-left">
										{ pick.actual.W }-{ pick.actual.L }
									</td>
									<td className="txt-italic">
										 { pick.actual.W_PCT }
									</td>
									<td className="border-left txt-bold txt-positive" style={{ width: "10%" }}>
										{ pick.score.total }
									</td>
									<td>
										<Ticker value={ pick.difference.total } />
									</td>
								</tr>
							);
						}) }
					</tbody>
				</table>
			</div>
		);
	}

}

export default UserTable;