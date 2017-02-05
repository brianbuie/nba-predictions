import ImageSelect from '../ImageSelect/ImageSelect';
import Nav from '../Nav/Nav';
import React, { Component } from 'react';
import StandingsGraph from '../StandingsGraph/StandingsGraph';
import StandingsTable from '../StandingsTable/StandingsTable';
import UserCard from '../UserCard/UserCard';
import UserGraph from '../UserGraph/UserGraph';
import UserTable from '../UserTable/UserTable';

import './Layout.css';

class Layout extends Component {

	constructor(props){
		super(props);
		this.state = {
			graphSizes: {
				user: {
					width: 0,
					height: 0
				},
				standings: {
					width: 0,
					height: 0
				}
			}
		};
	}

	render() {
		return (
			<div>
				<Nav { ...this.props }/>
				<div className="container">
					<div className="row">
						<div className="col-xs-12 no-padding" id="user-graph" style={{ minHeight: this.state.graphSizes.user.height }}>
							<UserGraph { ...this.props } { ...this.state } />
						</div>
					</div>
					<div className="row no-padding-bottom" id="user-cards">
						{ this.props.users.map( user => { 
							return (
								<div className="col-xs-3 no-padding" key={user.name}>
									<UserCard {...this.props} user={user} />
								</div>
							); 
						}) }
					</div>
					<div className="row no-padding-top">
						<div className="col-lg-6 active">
							<UserTable conference="West" { ...this.props }/>
						</div>
						<div className="col-lg-6 active">
							<UserTable conference="East" { ...this.props }/>
						</div>
					</div>
					<div className="row">
						<div className="col-sm-3" id="standings-table">
							<StandingsTable { ...this.props } />
						</div>
						<div className="col-sm-9" id="standings-graph" style={{ minHeight: this.state.graphSizes.standings.height }}>
							<StandingsGraph {...this.props} {...this.state} />
						</div>
					</div>
					<div className="row">
						<div className="col-md-4 offset-md-4">
							<ImageSelect { ...this.props } />
						</div>
					</div>
				</div>
			</div>
		);
	}

	componentDidMount(){
		this.setState({
			graphSizes: {
				user: {
					width: document.getElementById('user-cards').clientWidth,
					height: document.getElementById('user-cards').clientHeight
				},
				standings: {
					width: document.getElementById('standings-table').clientWidth,
					height: document.getElementById('standings-table').clientHeight
				}
			}
		});
	}
}

export default Layout;