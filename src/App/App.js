// dependencies
import Api from '../Api/Api';
import Layout from '../Layout/Layout';
import Loading from '../Loading/Loading';
import Moment from 'moment';
import React, { Component } from 'react';
// css
import './App.css';

class App extends Component {

	componentWillMount(){
		this.setState({ loading: true });
		Api.get('date=2016-11-11', (data) => { 
			this.setState( data[0] );
			this.setState({ loading: false });
		});
	}

	render() {
		return (
			<div>
				{ this.state.loading ? <Loading /> : this.layout() }
			</div>
		);
	}

	layout() {
		let date = new Moment(this.state.date);
		return (
			<Layout
				title={date.format('MMMM D, Y')}
				standings={this.state.standings}
				users={this.state.users}
			/>
		);
	}


}

export default App;
