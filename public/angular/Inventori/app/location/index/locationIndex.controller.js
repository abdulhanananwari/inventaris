
app
	.controller('LocationIndexController', function(
		LocationModel) {
		var vm = this
		vm.load = function() {

			LocationModel.index()
		.success(function(data) {
			vm.locations = data.data;
		
		vm.storagelocation = {}

			$('#edit-data').modal('hide')

		})	
		}

		vm.new = function() {

			vm.storagelocation = {}

			$('#edit-data').modal('show')

		}

		vm.store = function(storagelocation) {
			
				/*console.log(storagelocation);*/

			if (!storagelocation.id) {
					
					LocationModel.store(storagelocation)
					.success(function(data) {
						vm.load()

					})

			} else {

				LocationModel.update(storagelocation.id, storagelocation)
				.success(function(data) {
					vm.load()
					vm.storagelocation = data
					alert('Data Berhasil Di update')
				})
				
			}

		}
		vm.edit = function(storagelocation) {
			vm.storagelocation = storagelocation
			$('#edit-data').modal('show')
		}
		vm.load()

		vm.filter = {};

		vm.get = function(page) {
			if (page) {
				vm.filter.page = page;
			}

			LocationModel.index(vm.filter)
			.success(function(data) {
				vm.locations = data.data;
				vm.meta =data.meta;
			})
		} 
		vm.get();
	});