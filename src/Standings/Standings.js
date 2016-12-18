import React, { Component } from 'react';

class Standings extends Component {

	render() {
		return (
			<div className="col-lg-6">
				<div className="table-responsive">
					<table className="table table-sm table-inverse">
						<thead>
							<tr className="bg-brand-primary">
								<th className="txt-right"></th>
								<th className="txt-center"> Rank </th>
								<th className="txt-capitalize">{ this.props.conference }</th>
								<th className="txt-center"> Record </th>
								<th className="txt-center"> Win % </th>
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
		let teams = this.props.standings.map((team, i) => {
			let className = i > 7 ? "txt-faded" : "";
			return (
				<tr className={ className } key={ team.ABRV }>
					<td className="txt-right">
						-
					</td>
					<td className="txt-center">
						{ i + 1 }
					</td>
					<td>
						{ team.TEAM }
					</td>
					<td className="txt-center">
						{ team.W }-{ team.L }
					</td>
					<td className="txt-center">
						<i>{ team.W_PCT }</i>
					</td>
				</tr>
			);
		});
		return teams;
	}
}

export default Standings;