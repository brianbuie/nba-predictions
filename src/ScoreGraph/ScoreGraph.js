import React, { Component } from 'react';
import './ScoreGraph.css';
import { Line } from 'react-chartjs';

class ScoreGraph extends Component {

	render() {
		return (
			<div className="row">
				<div className="col-xs-12">
					{ this.createChart() }
				</div>
			</div>
		);
	}

	createChart(){
		return (<Line 
			data={{
				labels: this.props.allScores[0].data.map( date => { return date.label; }),
				datasets: this.props.allScores.map( user => {
					return {
						label: user.label,
						data: user.data.map( entry => { return entry.y; }),
						fill: false,
						backgroundColor: null,
						pointRadius: 0,
					}
				})
			}} 
			options={{
				responsive: true,

			}}
		/>);
	}

}

export default ScoreGraph;