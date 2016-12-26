import React, { Component } from 'react';
import './ScoreGraph.css';
import { Line } from 'react-chartjs-2';

class ScoreGraph extends Component {

	render() {
		return (
			<div className="row">
				<div className="col-xs-12 no-padding">
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
						borderColor: this.props.userColors[user.label],
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
				onClick: (e) => { console.log(e); },
				legend: {
					display: false,
				},
				tooltips: {
					enabled: true,
					intersect: false
				},
				scales: {
					xAxes: [{
						display: false
					}]
				}
			}}
		/>);
	}

}

export default ScoreGraph;