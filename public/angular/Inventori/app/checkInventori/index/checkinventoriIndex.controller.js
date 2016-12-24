app
	.controller('CheckInventoriIndexController', function (
		CheckInventoriModel,$stateParams) {
		var vm =this;


		vm.filter = {};

		vm.get = function(page) {

			if (page) {
				vm.filter.page = page;
			}
			CheckInventoriModel.index()
			.success(function(data) {
				vm.checkInventoris = data.data;
				vm.meta = data.meta;
			})
		} 
		vm.get()
		
	});