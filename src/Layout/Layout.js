import ImageSelect from '../ImageSelect/ImageSelect';
import Nav from '../Nav/Nav';
import React, { Component } from 'react';
import StandingsTable from '../StandingsTable/StandingsTable';
import UserCard from '../UserCard/UserCard';
import UserGraph from '../UserGraph/UserGraph';
import UserTable from '../UserTable/UserTable';

import './Layout.css';

class Layout extends Component {

	render() {
		return (
			<div>
				<Nav { ...this.props }/>
				<div className="container">
					<div className="row">
						<div className="col-xs-12 no-padding">
							{ this.props.allScores ? <UserGraph { ...this.props } /> : null }
						</div>
					</div>
					<div className="row no-padding-bottom">
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
						<div className="row">
							<div className="col-md-3">
								<StandingsTable { ...this.props } />
							</div>
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
}

export default Layout;