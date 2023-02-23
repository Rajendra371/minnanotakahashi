import React,{useContext} from 'react'
import FacebookLogin from 'react-facebook-login';
import { AuthContext } from '../context/AuthContext';


function FacebookUserLogin() {
    const {facebookLogin} = useContext(AuthContext)

const componentClicked = (e) => {
    console.log('Clicked');
}

const resposneFacebook = (response) => {
    console.log(response);
    facebookLogin(response); 
}

    return (
            <FacebookLogin
            appId="307869803993345"
            autoLoad={false}
            fields="name,email,picture"
            onClick={componentClicked}
            size="medium"
            textButton=	"Login with Facebook"
            // cssClass="my-facebook-button-class"
            icon="fa-facebook"
            callback={resposneFacebook}
            />
    )
}

export default FacebookUserLogin
