class AppStorage {
    // adding token to local storage
    storeToken(token) {
        localStorage.setItem("token", token);
    }

    // adding user data to local storage
    storeUser(user) {
        localStorage.setItem("user", user);
    }

    // method to store toten and user
    store(token, user) {
        this.storeToken(token);
        this.storeUser(user);
    }

    // remove Item from token and user
    clear() {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
    }

    getToken() {
        localStorage.getItem(token);
    }

    getUser() {
        localStorage.getItem(user);
    }
}

export default AppStorage = new AppStorage();