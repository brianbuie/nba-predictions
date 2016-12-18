import React, { Component } from 'react';

class PickTable extends Component {

	render() {
		let picks = this.props.picks.map((pick, i) => {
			let className = pick.placement['correct_pct'] < 1 ? "txt-faded" : "";
			return (
				<tr className={ className } key={ this.props.user + "-" + this.props.conferece + "-" + i }>
					<td>
						{ i + 1 }
					</td>
					<td>
						{ pick.actual.ABRV }
					</td>
					<td className="border-left">
						{ pick.wins }-{ (82 - pick.wins) }
					</td>
					<td className="txt-italic">
						{ pick.w_pct.predicted }
					</td>
					<td className="border-left">
						{ pick.actual.W }-{ pick.actual.L }
					</td>
					<td className="txt-italic">
						 { pick.actual.W_PCT }
					</td>
					<td className="border-left txt-bold txt-positive">
						{ pick.score }
					</td>
					<td>
						-
					</td>
				</tr>
			);
		});
		return (
			<div className="col-lg-6">
				<div className="table-responsive table-inverse">
					<table className="table table-sm">
						<thead>
							<tr>
								<th> Rank </th>
								<th>{ this.props.conference }</th>
								<th colSpan="2"> Predicted </th>
								<th colSpan="2"> Current </th>
								<th colSpan="2"> Points </th>
							</tr>
						</thead>
						<tbody>
						{ picks }
						</tbody>
					</table>
				</div>
			</div>
		);
	}

}

export default PickTable;