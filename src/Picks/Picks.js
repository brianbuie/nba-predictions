import PickTable from './PickTable';
import React, { Component } from 'react';

class Picks extends Component {

	render() {
		let users = this.props.users.map((user, i) => {
			return (
				<div className="row" key={user.name + "-picks"}>
					<div className="col-xs-12">
						<h5 className="txt-capitalize">
							{ user.name }
						</h5>
						<h3 className="txt-positive spaced-out-md">
							{ user.score }
						</h3>
					</div>
					<PickTable conference="West" picks={ user.picks.west } user="user.name" />
					<PickTable conference="East" picks={ user.picks.east } user="user.name" />
				</div>
			);
		})
		return (<div>{ users }</div>);
	}

}

export default Picks;