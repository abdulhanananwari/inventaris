var SolumaxFileManagerShow = angular
	.module('Solumax.FileManager', [])
	.directive('fileManagerIndexModal', function(
		FileFactory,
		$sce, $http, $timeout) {

		return {
			templateUrl: $sce.trustAsResourceUrl('/solumax/file-manager/v2/file-manager-index-modal.html'),
			restrict: 'AE',
			scope: {
				displayType: "@",
				fileUuid: "@",
				fileId: "@",
			},
			link: function(scope, elem, attrs) {

				scope.modalId = Math.random().toString(36).substring(2, 7)

				scope.search = function() {
					FileFactory.index(scope.filter)
					.success(function(data) {
						scope.files = data.data
						scope.meta = data.meta
					})
				}

				scope.copyLink = function(file) {
					window.prompt("Copy to clipboard: Ctrl+C, Enter", file.full_url);
				}


			}
		}
		
	})
	.directive('fileManagerIndex', function(
		FileFactory,
		$sce, $http, $timeout) {

		return {
			templateUrl: $sce.trustAsResourceUrl('/solumax/file-manager/v2/file-manager-index.html'),
			restrict: 'AE',
			scope: {
				fileableType: "@",
				fileableId: "@",
			},
			link: function(scope, elem, attrs) {

				scope.modalId = Math.random().toString(36).substring(2, 7)

				scope.load = function() {

					FileFactory.index({fileable_type: scope.fileableType, fileable_id: scope.fileableId})
					.success(function(data) {
						scope.files = data.data
						scope.meta = data.meta
					})
				}
				scope.load()

				scope.copyLink = function(file) {
					window.prompt("Copy to clipboard: Ctrl+C, Enter", file.full_url);
				}


			}
		}
		
	})
	.directive('fileManagerShow', function(
		FileFactory,
		$sce, $http, $timeout) {

		return {
			templateUrl: $sce.trustAsResourceUrl('/solumax/file-manager/v2/file-manager-show.html'),
			restrict: 'AE',
			scope: {
				displayType: "@",
				fileUuid: "@",
				fileId: "@",
			},
			link: function(scope, elem, attrs) {

				scope.$watch(function() {
					return scope.fileUuid
				}, function(value) {
					scope.loadByUuid()
				})

				scope.loadByUuid = function() {

					if (!_.isUndefined(scope.fileUuid) && !_.isEmpty(scope.fileUuid)) {

						FileFactory.getUuid(scope.fileUuid)
						.success(function(data) {
							scope.file = data.data
							scope.file.full_url = $sce.trustAsResourceUrl(scope.file.full_url)
						})
						
					} 
				}

				scope.$watch(function() {
					return scope.fileId
				}, function(value) {
					scope.loadById()
				})


				scope.loadById = function() {

					if (!_.isUndefined(scope.fileId) && !_.isEmpty(scope.fileId)) {
						
						FileFactory.get(scope.fileId)
						.success(function(data) {
							scope.file = data.data
							scope.file.full_url = $sce.trustAsResourceUrl(scope.file.full_url)
						})
					}
				}


			}
		}
		
	})
	.directive('fileManagerUpload', function(
		FileFactory,
		$sce, $http, $timeout) {

		return {
			templateUrl: $sce.trustAsResourceUrl('/solumax/file-manager/v2/file-manager-upload.html'),
			restrict: 'AE',
			scope: {
				displayedInput: "@",
				additionalData: "@",
				validations: "@",
				
				uploadedFile: "=",
				onFileUploaded: "&"
			},
			link: function(scope, elem, attrs) {

				scope.boxId = "-" + Math.random().toString(36).substring(2, 7)

				scope.formData = {
					name: '',
					description: ''
				}

				scope.validate = function() {

					var validations = JSON.parse(scope.validations)

					if (validations.fileSize) {
						var fileSize = document.getElementById('file-manager-file-'+scope.boxId).files[0].size / 1024;
						if (validations.fileSize < fileSize) {
							alert('Ukuran file maximal ' + validations.fileSize + ' KB')
							return false
						}
					}

					return true
				}

				scope.upload = function() {

					scope.uploading = true;

					if (typeof document.getElementById('file-manager-file-'+scope.boxId).files[0] == 'undefined') {
						alert('File belum dipilih')
						scope.uploading = false;
						return 
					}

					if (scope.validations) {
						if (!scope.validate()) {
							scope.uploading = false
							return 
						}
					}

					var fd = new FormData();
					fd.append('file', document.getElementById('file-manager-file-'+scope.boxId).files[0]);

					_.each(JSON.parse(scope.additionalData), function(item, key) {
						fd.append(key, item);
					})

					for (var key in scope.formData) {
						fd.append(key, scope.formData[key]);
					}

					var config = {
						transformRequest: angular.identity,
						headers: {'Content-Type': undefined}
					}

					FileFactory.store(fd, config)
					.success(function(data) {
						scope.uploadedFile = data.data

						$timeout(function() {
							scope.onFileUploaded()
							scope.uploading = false
							alert('Upload berhasil')
							scope.reset()
						}, 250)
					})
					.error(function() {
						scope.uploading = false
						alert('Upload gagal')
					})
				}

				scope.reset = function() {
					document.getElementById("file-manager-upload-form-"+scope.boxId).reset()
				}

				scope.display = JSON.parse(scope.displayedInput)
			}
		}
		
	})
	.factory('FileFactory', function(
		$http) {

		var fileFactory = {}

		fileFactory.store = function(formData, config) {
			return $http.post('/file-manager/file/', formData, config)
		}

		fileFactory.index = function(params) {
			return $http.get('/file-manager/file/', {params: params})
		}

		fileFactory.get = function(id) {
			return $http.get('/file-manager/file/' + id)
		}

		fileFactory.getUuid = function(id) {
			return $http.get('/file-manager/file/uuid/' + id)
		}


		return fileFactory
	})