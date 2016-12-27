import React, { Component } from 'react';

class ImageSelect extends Component {

	render() {
		let host = window.location.hostname === "localhost" ? "http://localhost:80/nba/" : "/";
		return (
			<form action={host + 'api/post-image.php'} method="post">
				<h3 className="spaced-out-md">Add New User Image</h3>
				<div className="form-group">
					<select className="form-control" name="name">
						{ this.props.users.map( user => { 
							return( <option value={user.name} key={user.name}> {user.name} </option> )
						})}
					</select>
				</div>
				<div className="form-group">
					<input type="url" className="form-control" name="image" placeholder="Image URL" />
				</div>
				<div className="form-group">
					<input type="password" className="form-control" name="password" placeholder="Password" />
				</div>
				<div className="form-group">
					<button type="submit" className="btn btn-primary btn-block">Submit</button> 
				</div>
			</form>
		);
	}
}

export default ImageSelect;