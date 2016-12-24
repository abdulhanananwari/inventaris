app
	.factory('CheckInventoriModel', function(
		$http) {

		var checkInventoriModel = {}

		var baseUrl = '/api/checkInventori/'

		checkInventoriModel.index = function(params) {
			return $http.get(baseUrl, {params: params})
		}
		checkInventoriModel.get = function(id) {
			return $http.get(baseUrl + id)
		}
		checkInventoriModel.store = function(checkInventori) {
			return $http.post(baseUrl, checkInventori)
		}
		checkInventoriModel.update = function(id, checkInventori) {
			return $http.post(baseUrl + id, checkInventori)
		}

		return checkInventoriModel

	})