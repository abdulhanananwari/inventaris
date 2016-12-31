app
	.controller('InventoriShowController', function (InventoriModel,
		MaintenanceInventoriModel,
		CheckInventoriModel,
		LocationModel,
		ConfigModel,
		$state) {
		var vm = this;

		vm.storagelocation = {}

		vm.inventori = {
			tanggal_pembelian: moment().format("YYYY-MM-DD"),
			rencana_tanggal_peremajaan: moment().format("YYYY-MM-DD"),
			pic: []
		}

		$( "#rencana_tanggal_peremajaan" ).datepicker({ dateFormat: "yy-mm-dd" });
		$( "#tanggal_pembelian" ).datepicker({ dateFormat: "yy-mm-dd" });
		
		vm.store = function(inventori) {
			if (!inventori.id) {

				InventoriModel.store(inventori)
				.success(function(data) {
					alert('Data Berhasil Di Simpan')
					$state.go('inventoriShow', {id: data.data.id})
					
				})
			} else {
				InventoriModel.update(inventori.id, inventori)
				.success(function(data) {
					vm.inventori = data.data
					alert('Data Berhasil Di Update')
				})
			}
		}
		vm.reset = function() {
			$state.go('inventoriShow', {id: ''}, {reload: true})
		}

		vm.addPic = function(pic) {

			if (_.isEmpty(pic.email)) {

					alert('Email Diperlukan')
					return ;
			}

			vm.inventori.pic .push( _.pick(pic,['user_id','name','email']));
		}

		vm.remove=function(pic) {
			_.remove(vm.inventori.pic, pic);
		}

		vm.filter = {
			inventori_id: $state.params.id
		}

		vm.getmaintenance = function(page) {
			if (page) {
				vm.filter.page = page;
			}

			MaintenanceInventoriModel.index(vm.filter,['maintenances'])
			.success(function(data) {
				vm.maintenances = data.data;
				vm.meta =data.meta;
			})

		}
		

		vm.getcheck = function(page) {
			if (page) {
				vm.filter.page = page;
			}

			CheckInventoriModel.index(vm.filter,['checkInventoris'])
			.success(function(data) {
				vm.checkInventoris = data.data;
				vm.metaCheckInventori =data.meta;
			})
		} 

		if ($state.params.id) {

			InventoriModel.get($state.params.id)
			.success(function(data) {
				vm.inventori = data.data;
			})

			vm.getcheck()

			vm.getmaintenance()
		} 
		
		ConfigModel.get('kondisi')
		.success(function(data) {
			vm.kondisi = data.data
		})

		LocationModel.index()
		.success(function(data) {
			vm.locations = data.data;
		})

	});