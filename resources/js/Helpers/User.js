import Token from './Token'
import AppStorage from './AppStorage'

class User {
	responseAfterLogin(response) {
		const access_token = response.data.access_token
		const name = response.data.name
		if (Token.isValid(access_token)) {
			AppStorage.storeToken(access_token);
			AppStorage.storeUser(name);
		}
		return "Bau nai";
	}

	hasToken() {
		const storeToken = localStorage.getItem('token');
		if (storeToken) {
			return Token.isValid(storeToken) ? true : false
		}
		return false;
	}

	loggedIn() {
		return this.hasToken()
	}

	logout() {
		AppStorage.clear()
	}

	name() {
		if (this.loggedIn()) {
			return localStorage.getItem('user')
		}
	}

	id(){
		if (this.loggedIn()) {
			const payload = Token.payload(localStorage.getItem('token'))
		}	return payload.sub
		return false
	}	
}

export default User = new User();