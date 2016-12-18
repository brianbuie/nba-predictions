// dependencies
import Nav from '../Nav/Nav';
import Picks from '../Picks/Picks';
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
						/>
						<Standings
							conference="East"
							standings={ this.props.standings.east }
						/>
					</div>
					<Picks users={ this.props.users } />
				</div>
			</div>
		);
	}


}

export default Layout;