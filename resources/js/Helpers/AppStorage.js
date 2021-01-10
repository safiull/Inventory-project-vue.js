class AppStorage{
	storeToken(token){
		localStorage.setItem('token', token);
	}

	storeUser(user){
		localStorage.setItem('user', user);
	}

	store(token,user){
		this.storeToken('token', token);
		this.storeUser('user', user);
	}

	clear(token,user){
		localStorage.removeItem('token');
		localStorage.removeItem('user');
	}

	getToken(){
		localStorage.getItem('token');
	}

	getToken(){
		localStorage.getItem('user');
	}


}

export default AppStorage = new AppStorage();