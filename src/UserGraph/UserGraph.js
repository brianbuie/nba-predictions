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
				ref='UserGraph'
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
						}
					})
				}} 
				options={{
					responsive: true,
					elements: {
						point: {
							radius: 0,
							hoverRadius: 5,
							hitRadius: 5
						}
					},
					tooltips: {
						enabled: false
					},
					legend: {
						display: false,
					},
					scales: {
						xAxes: [{
							gridLines: {
								display: false
							},
							ticks: {
								display: false
							}
						}],
						yAxes: [{
							gridLines: {
								display: false
							},
							ticks: {
								fontColor: 'rgba(62, 93, 144, 0.7)'
							}
						}]
					}
				}}
			/>
		);
	}

	componentDidMount(){
		// this.drawTodayLine();
	}

	componentWillUpdate(){
		// this.drawTodayLine();
	}

	// drawTodayLine() {
	// 	let originalDraw = Chart.controllers.line.prototype.draw;
	// 	let date = this.props.date;
	// 	Chart.controllers.line.prototype.draw = function (ease) {
	// 		originalDraw.call(this, ease);
	// 		let scale = this.chart.scales['x-axis-0'];
	// 		let dateKey = Object.keys(scale.ticks).filter( key => { return scale.ticks[key] === date })[0];
	// 		let left = (dateKey / (scale.ticks.length - 1)) * (scale.right - scale.left);

	// 		this.chart.chart.ctx.beginPath();
	// 		this.chart.chart.ctx.strokeStyle = 'rgba(255, 255, 255, 0.7)';
	// 		this.chart.chart.ctx.lineWidth = 1;
	// 		this.chart.chart.ctx.moveTo(scale.left + left, 0);
	// 		this.chart.chart.ctx.lineTo(scale.left + left, 100000);
	// 		this.chart.chart.ctx.stroke();
	// 	}
	// }

}

export default UserGraph;