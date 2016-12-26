import PickTable from './PickTable';
import React, { Component } from 'react';

class Picks extends Component {

	render() {
		return (
			<div className="row no-padding-top">
				<PickTable conference="West" picks={this.filterPicks(this.props.user.picks, "West")}/>
				<PickTable conference="East" picks={this.filterPicks(this.props.user.picks, "East")}/>
			</div>
		);
	}

	filterPicks(picks, conference){
		return picks.filter(pick => {
			return pick.actual.CONFERENCE === conference;
		}).sort((a, b) => {
			if(a.RANK < b.RANK){ return 1; }
			if(a.RANK > b.RANK){ return -1; }
			return 0;
		});
	}

}

export default Picks;