app
	.factory('LinkFactory', function() {

		var env = window.location.hostname == '192.168.0.227' ? 'dev' : 'prod';

		var domains = {
		
			account: 'https://accounts.xolura.com/',
		}

		var apps = {
			
			authentication: domains.account + 'views/user/',
		};

		return {

			authentication: {
				login: apps.authentication + 'authentication/login',
				tenantSelect: apps.authentication + 'token-exchange/tenant-select'
				

			},
			entity: {
				base: 'https://entity.hondagelora.com/'
			}
		}


	});