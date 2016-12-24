app
	.factory('ConfigModel', function(
		$http) {

		var configModel = {}

		var baseUrl = '/api/config/'

		configModel.index = function(params) {
			return $http.get(baseUrl, {'params': params})
		}
		configModel.get = function(id) {
			return $http.get(baseUrl + id)
		}
		configModel.store = function(config) {
			return $http.post(baseUrl, config)
		}
		configModel.update = function(id, config) {
			return $http.post(baseUrl + id, config)
		}

		return configModel

	})