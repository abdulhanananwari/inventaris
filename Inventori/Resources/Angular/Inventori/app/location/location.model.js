app
	.factory('LocationModel', function(
		$http) {

		var locationModel = {}

		var baseUrl = '/api/location/'

		locationModel.index = function(params) {
			return $http.get(baseUrl, {'params': params})
		}
		locationModel.get = function(id) {
			return $http.get(baseUrl + id)
		}
		locationModel.store = function(storagelocation) {
			return $http.post(baseUrl, storagelocation)
		}
		locationModel.update = function(id, storagelocation) {
			return $http.post(baseUrl + id, storagelocation)
		}

		return locationModel

	})