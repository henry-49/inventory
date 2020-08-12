class Token {
    // checking if token is valid
    isValid(token){
        const payload = this.payload(token)
        if(payload){
            return payload.iss = "http://127.0.0.1:8000/api/auth/login" || "http://127.0.0.1:8000/api/auth/signup" ? true : false
        }

        return false
    }

    payload(token){
        // spliting one part of the token
        const payload = token.split('.')[1]
        return this.decode(payload)
    }
 
    decode(payload){
        // The atob() method decodes a base-64 encoded string.
        return JSON.parse(atob(payload))
    }
}

export default Token = new Token();
