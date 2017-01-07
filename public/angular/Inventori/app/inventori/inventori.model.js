app
	.factory('InventoriModel', function(
		$http) {

		var inventoriModel = {}

		var baseUrl = '/api/inventori/'

		inventoriModel.index = function(params) {
			return $http.get(baseUrl, {'params': params})
		}
		inventoriModel.get = function(id) {
			return $http.get(baseUrl + id)
		}
		inventoriModel.generate = function(inventori) {
			return $http.get(baseUrl + 'uuid/' + id)
		}
		inventoriModel.store = function(inventori) {
			return $http.post(baseUrl, inventori)
		}
		inventoriModel.update = function(id, inventori) {
			return $http.post(baseUrl + id, inventori)
		}
		

		return inventoriModel

	})