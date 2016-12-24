app
	.controller('CheckInventoriCreateController', function (CheckInventoriModel,$state) {
		var vm = this;
		
		vm.checkInventori = {
			inventori_id: $state.params.inventoriId
		}

		if ($state.params.id) {

			CheckInventoriModel.get($state.params.id)
			.success(function(data) {
				vm.checkInventori = data.data;
			})
		}

		vm.store = function(checkInventori) {
			if (!checkInventori.id) {

				vm.checkInventori = {}

				CheckInventoriModel.store(checkInventori)
				.success(function(data) {
					$state.go('inventoriIndex', {id: data.id})
				})
			} else {
				CheckInventoriModel.update(checkInventori.id, checkInventori)
				.success(function(data) {
					vm.checkInventori = data
				})
			}
		}
		vm.reset = function() {
			$state.go('checkInventoriCreate', {id: ''}, {reload: true})
		}
	});