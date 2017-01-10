app
        .controller('CheckInventoriCreateController', function (CheckInventoriModel,
                InventoriModel,
                $state) {
            var vm = this;

            vm.checkInventori = {
                inventori_id: $state.params.inventoriId,
                photos: []
            }

            if ($state.params.id) {

                CheckInventoriModel.get($state.params.id)
                        .success(function (data) {
                            vm.checkInventori = data.data;
                        })
            }

            vm.store = function (checkInventori) {

                if (!checkInventori.id) {

                    vm.checkInventori = {}

                    CheckInventoriModel.store(checkInventori)
                            .success(function (data) {
                                alert('Data Berhasil Di Simpan. Silahkan upload foto sekarang.')
                                $state.go('checkInventoriCreate', {id: data.data.id})
                            })

                } else {

                    CheckInventoriModel.update(checkInventori.id, checkInventori)
                            .success(function (data) {
                                vm.checkInventori = data.data;
                            })
                }
            }
            vm.reset = function () {
                $state.go('checkInventoriCreate', {id: ''}, {reload: true})
            }

            vm.addPhotos = function (photos) {

                vm.checkInventori.photos.push(_.pick(photos, ['id', 'uuid']));
            }

            vm.fileManager = {
                displayedInput: JSON.stringify({
                    name: {label: "Keterangan", show: true},
                    file: {label: "Bukti Photo", show: true},
                    reset: {show: true}
                }),
                additionalData: JSON.stringify({
                    path: 'check-inventori',
                    subpath: $state.params.id,
                    fileable_type: 'CheckInventori',
                    fileable_id: $state.params.id
                })
            }
        });