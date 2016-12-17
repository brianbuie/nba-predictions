import React, { Component } from 'react';
import Api from '../Api/Api';
import './App.css';

class App extends Component {
	render() {
		Api.get('date=2016-11-11', (data) => { console.log(data); });
		return (
			<div className="App">

			</div>
		);
	}
}

export default App;
