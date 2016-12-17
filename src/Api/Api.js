function get(query, callback) {
	let host = window.location.hostname === "localhost" ? "http://localhost:80/nba/" : "/";
	return fetch(`${host}api/?${query}`, {
		accept: 'application/json',
	}).then(checkStatus)
		.then(parseJSON)
		.then(callback);
}

function checkStatus(response) {
	if (response.status >= 200 && response.status < 300) {
		return response;
	} else {
		const error = new Error(`HTTP Error ${response.statusText}`);
		error.status = response.statusText;
		error.response = response;
		console.log(error);
		throw error;
	}
}

function parseJSON(response) {
	return response.json();
}

const Api = { get };
export default Api;