app
        .controller('InventoriLogController', function (
                LogModel,
                ConfigModel,
                $state) {
            var vm = this;

            vm.filter = {
                loggable_type: 'Inventori',
                loggable_id: $state.params.id
            };

            LogModel.index(vm.filter)
                    .success(function (data) {

                        vm.logs = data.data;

                        assignKondisiToLog()

                    })

            function assignKondisiToLog() {


                _.each(vm.logs, function (log) {

                    log.data_one.object_kondisi = _.first(_.filter(vm.kondisi, function (kondisi) {
                        return kondisi.code == log.data_one.kondisi
                    }))
                })
            }

            ConfigModel.get('kondisi')
                .success(function (data) {
                vm.kondisi = data.data
            })

             vm.back = function () {
                $state.go('inventoriShow', {id: $state.params.id })
            }

        });
		