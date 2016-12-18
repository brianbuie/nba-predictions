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
		this.fetchData();
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
				title={ date.format('MMMM D, Y') }
				standings={ this.state.standings }
				users={ this.state.users }
				prevLink={ () => { this.handleDateChange(-1) } }
				nextLink={ () => { this.handleDateChange(1) } }
			/>
		);
	}

	handleDateChange(ordinal){
		let date = new Moment(this.state.date);
		date.add(ordinal + ' days');
		this.fetchData( date.format('YYYY-MM-DD') );
	}

	fetchData(date){
		this.setState({ loading: true });
		let query = date ? 'date=' + date : null;
		Api.get(query, (data) => { 
			this.setState( data[0] );
			this.setState({ loading: false });
		});
	}


}

export default App;
