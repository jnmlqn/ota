import axios from 'axios';

export default class Api
{
	private url:string = 'https://ota.ddev.site/api/';

    login(data: array, userType: string) {
		axios.post(this.url + 'login', data)
	    .then((response) => {
	        let resp = response.data;
	        document.cookie = `access_token=${resp.data.token}`;
	        window.location = userType === 'seeker'
	        	? '/job-board'
	        	: '/create-job';
	    })
	    .catch((error) => {
	        console.log(error);
	    });
	}

	checkAuth() {
		this.get('user')
		.then((response) => {
			console.log(response);
		})
	    .catch((error) => {
	        window.location = '/';
	    });
	}

	get(endpoint: string, data: array = {}) {
		return axios({
			method: 'get',
			url: this.url + endpoint,
			data: data,
			headers: {
				Authorization: 'Bearer ' + this.getAccessToken()
			}
		});
	}

	post(endpoint: string, data: array = {}) {
		return axios({
			method: 'post',
			url: this.url + endpoint,
			data: data,
			headers: {
				Authorization: 'Bearer ' + this.getAccessToken()
			}
		});
	}

	getAccessToken() {
        let name = 'access_token' + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');

        for(let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }

            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }

        return "";
    }
}