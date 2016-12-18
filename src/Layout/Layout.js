// dependencies
import Nav from '../Nav/Nav';
import React, { Component } from 'react';
import Scoreboard from '../Scoreboard/Scoreboard';
import Standings from '../Standings/Standings';
// css
import './Layout.css';

class Layout extends Component {

	render() {
		return (
			<div>
				<Nav leftLink="#" title={ this.props.title } rightLink="#" />
				<div className="container">
					<Scoreboard users={ this.props.users } />
					<div className="row">
						<Standings
							conference="West"
							standings={ this.props.standings.west }
							className="col-lg-6"
						/>
						<Standings
							conference="East"
							standings={ this.props.standings.east }
							className="col-lg-6"
						/>
					</div>
				</div>
			</div>
		);
	}


}

export default Layout;