import Loading from '../Loading/Loading';
import React, { Component } from 'react';
import { Line } from 'react-chartjs-2';

class UserGraph extends Component {

	render(){
		if(!this.props.allScores){
			return <Loading />
		}
		let data = this.props.allScores;
		return (
			<Line
				height={ this.props.graphSizes.user.height }
				width={ this.props.graphSizes.user.width }
				data={{
					labels: data[0].data.map( entry => { return entry.date; }),
					datasets: data.map( user => {
						return {
							borderWidth: 2,
							borderColor: this.props.userColors[user.name],
							label: user.name,
							data: user.data.map( entry => { return entry.score; }),
							fill: false,
							backgroundColor: null,
							pointRadius: 0,
						}
					})
				}} 
				options={{
					responsive: true,
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

export default UserGraph;