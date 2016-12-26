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
				{ this.state.loading ? <Loading /> : null }
				{ this.state.standings ? 
					<Layout 
						{ ...this.state } 
						dateChange={(delta) => { this.handleDateChange(delta) } }
						handleImageSelect={ () => { this.handleImageSelect() } }
					/> 
				: null }
			</div>
		);
	}

	handleDateChange(delta){
		let date = new Moment(this.state.date).add(delta, 'days');
		this.fetchData(date.format('YYYY-MM-DD'));
	}

	handleImageSelect(){
		console.log('image submitted');
	}

	fetchData(date){
		this.setState({ loading: true });
		let query_date = date ? '&date=' + date : "";
		let query = '?type=compare' + query_date;
		Api.get(query, (data) => { 
			this.setState( data[0] );
			this.fetchAllScores( () => { this.setState({ loading: false }) } );
		});
	}

	fetchAllScores(callback){
		if(this.state.allScores){ callback(); }
		Api.get( '?type=userscores&days=1000', (data) => {
			this.setState({ allScores: data });
			callback();
		});
	}


}

export default App;
