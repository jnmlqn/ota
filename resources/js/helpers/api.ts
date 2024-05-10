import axios from 'axios';

export default class Api
{
	private url:string = 'https://ota.ddev.site/api/';

    login(data: array) {
		return axios.post(this.url + 'login', data);
	}

	logout() {
		document.cookie = `access_token=''`;
        document.cookie = `role=''`;
        window.location = '/';
	}

	checkAuth(loginPage: bool = false) {
		this.get('user')
		.then((response) => {
			if (loginPage) {
				let userType = this.getCookieValue('role');
			
				window.location = userType === 'seeker'
		        	? '/job-board'
		        	: '/create-job';
			}
		})
	    .catch((error) => {
	        if (!loginPage) {
	        	window.location = '/';
	        }
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
        return this.getCookieValue('access_token');
    }

    getCookieValue(key: string) {
    	let name = key + "=";
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