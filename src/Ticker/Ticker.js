import React, { Component } from 'react';

class Ticker extends Component {

	render() {
		return (
			<span>
				{this.createMarkup()}
			</span>
		);
	}

	createMarkup(){
		let value = this.props.value;
		if(this.props.inverted){
			value *= -1;
		}
		if(value > 0){
			return(<span className="txt-positive"><i className="fa fa-caret-up"></i> {value} </span>);
		}
		if(value < 0){
			value *= -1; 
			return(<span className="txt-negative"><i className="fa fa-caret-down"></i> {value} </span>); 
		}
		if(value === 0){
			return(<span><i></i></span>);
		}
	}

}

export default Ticker;