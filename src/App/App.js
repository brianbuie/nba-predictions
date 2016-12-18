// dependencies
import Api from '../Api/Api';
import Layout from '../Layout/Layout';
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
			<Layout {...this.state} />
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
