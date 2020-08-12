import Token from './Token'
import AppStorage from "./AppStorage";

class User {
    responseAfterLogin(res) {
        // check if access_token and name exist
        const access_token = res.data.access_token;
        const username = res.data.name;

        // check if token is valid
        if (Token.isValid(access_token)) {
            // then store the access_token and username
            AppStorage.store(access_token, username);
        }
    }

    // if they have appropriate token
    hasToken() {
        const storeToken = localStorage.getItem('token');
        if (storeToken) {
            return Token.isValid(storeToken) ? true : false;
        }
        return false;
    }

    loggedIn() {
        return this.hasToken();
    }

    name() {
        // if user is loggedIn return name
        if (this.loggedIn()) {
            return localStorage.getItem('user');
        }
    }

    id() {
        if (this.loggedIn()) {
            // takes the valid token
           const payload = Token.payload(localStorage.getItem('token'));
           return payload.sub
        }
        return false
    }
}

export default User = new User();
