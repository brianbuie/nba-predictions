import Loading from '../Loading/Loading';
import React, { Component } from 'react';
import { Line } from 'react-chartjs-2';

class StandingsGraph extends Component {

	render(){
		if(!this.props.allRecords){
			return <Loading />
		}
		if(!this.props.allRecords[this.props.activeConference]){
			return <Loading />
		}
		let data = this.props.allRecords[this.props.activeConference];
		return (
			<Line
				height={ this.props.graphSizes.standings.height }
				width={ this.props.graphSizes.standings.width }
				data={{
					labels: data[0].data.map( (entry, i) => { return i; }),
					datasets: data.map( team => {
						return {
							borderWidth: team.team === this.props.activeTeam ? 4 : 2,
							borderColor: this.props.teamColors[team.team],
							label: team.team,
							data: team.data.map( entry => { return entry.diff; }),
							fill: false,
							lineTension: 0,
							spanGaps: false,
							backgroundColor: null,
							pointRadius: 0,
						}
					})
				}} 
				options={{
					responsive: true,
					maintainAspectRatio: false,
					hover: {
						intersect: false,
						mode: "x",
					},
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
			/>
		);
	}

}

export default StandingsGraph;