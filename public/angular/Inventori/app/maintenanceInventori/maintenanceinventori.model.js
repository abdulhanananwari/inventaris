app
	.factory('MaintenanceInventoriModel', function(
		$http) {

		var maintenanceInventoriModel = {}

		var baseUrl = '/api/maintenanceInventori/'

		maintenanceInventoriModel.index = function(params) {
			return $http.get(baseUrl, {params: params})
		}
		maintenanceInventoriModel.get = function(id) {
			return $http.get(baseUrl + id)
		}
		maintenanceInventoriModel.store = function(maintenance) {
			return $http.post(baseUrl, maintenance)
		}
		maintenanceInventoriModel.update = function(id, maintenance) {
			return $http.post(baseUrl + id, maintenance)
		}

		return maintenanceInventoriModel

	})