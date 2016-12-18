// dependencies
import Loading from '../Loading/Loading';
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
				{ this.props.loading ? <Loading /> : this.pageLayout() }
			</div>
		);
	}

	pageLayout(){
		return (
			<div>
				<Nav { ...this.props }/>
				<div className="container">
					<Scoreboard { ...this.props }/>
					<div className="row">
						<Standings
							conference="West"
							{ ...this.props }
						/>
						<Standings
							conference="East"
							{ ...this.props }
						/>
					</div>
					{ this.userPicks() }
				</div>
			</div>
		);
	}

	userPicks(){
		return this.props.users.map( user => {
			return( <Picks user={ user } standings={ this.props.standings } key={ user.name + "-picks" }/> );
		})
	}


}

export default Layout;