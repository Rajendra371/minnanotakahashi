import React,{useContext} from 'react'
import GoogleLogin from 'react-google-login';
import { AuthContext } from '../context/AuthContext';

function GoogleUserLogin() {
    const {googleLogin} = useContext(AuthContext);

    const onSuccess = (response) => {
        // console.log(response.profileObj);
        googleLogin(response.profileObj);
    }
    
    const onFailure = (response) => {
        console.log(response);
    }
    return (
            <GoogleLogin
            clientId="212140449869-e9do6k6nrg7rv7c4vks27ngovkpi8mek.apps.googleusercontent.com" 
            buttonText="Login With Google"
            onSuccess={onSuccess}
            onFailure={onFailure}
            autoLoad={false}
            cookiePolicy={'single_host_origin'}
            />  
    )
}

export default GoogleUserLogin
