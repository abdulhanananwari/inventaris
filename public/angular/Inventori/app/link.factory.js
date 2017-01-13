app
	.factory('LinkFactory', function() {

		var env = window.location.hostname == '192.168.0.227' ? 'dev' : 'prod';

		var domains = {
			inventori: window.location.origin + '/',
			account: 'https://accounts.xolura.com/',
		}

		var apps = {
			authentication: domains.account + 'views/user/',
			inventori: {
				api: domains.inventori + 'api/',
				report: domains.inventori + 'report/',
			}

		}

		return {

			authentication: {
				login: apps.authentication + 'authentication/login',
				tenantSelect: apps.authentication + 'token-exchange/tenant-select'
				

			},

			entity: {
				base: 'https://entity.hondagelora.com/'
			},

			inventori: {
				inventori: {
					api: apps.inventori.api + 'inventori/',
					report: apps.inventori.report + 'inventori/'
				}
			}
		}


	});