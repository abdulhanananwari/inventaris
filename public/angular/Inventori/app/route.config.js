app
 	.config(function($stateProvider, $urlRouterProvider) {

 		$urlRouterProvider.otherwise('/index');

 		$stateProvider
 		.state('index', {
 			url: '/index',
 			templateUrl: 'app/index/index.html',
 			controller: 'IndexController as ctrl',
 			requireLogin: false
 		})
 		.state('locationIndex', {
 			url:'/location/index',
 			templateUrl: 'app/location/index/locationIndex.html',
 			controller: 'LocationIndexController as ctrl'
 		})
 		.state('inventoriIndex', {
 			url:'/inventori/index',
 			templateUrl: 'app/inventori/index/inventoriIndex.html',
 			controller: 'InventoriIndexController  as ctrl'
 		})
 		.state('inventoriShow', {
 			url:'/inventori/show/:id',
 			templateUrl: 'app/inventori/show/inventoriShow.html',
 			controller: 'InventoriShowController as ctrl'
 		})
 		.state('maintenanceIndex', {
 			url:'/maintenance/index',
 			templateUrl: 'app/maintenanceInventori/index/maintenanceInventoriIndex.html',
 			controller: 'MaintenanceInventoriIndexController  as ctrl'
 		})
 		.state('maintenanceCreate', {
 			url:'/maintenance/create/:id/:inventoriId',
 			templateUrl: 'app/maintenanceInventori/create/maintenanceInventoriCreate.html',
 			controller: 'MaintenanceInventoriCreateController  as ctrl'
 		})
 		.state('checkInventoriIndex', {
 			url:'/checkinventori/index',
 			templateUrl: 'app/checkInventori/index/checkInventoriIndex.html',
 			controller: 'CheckInventoriIndexController  as ctrl'
 		})
 		.state('checkInventoriCreate', {
 			url:'/checkInventori/create/:id/:inventoriId',
 			templateUrl: 'app/checkInventori/create/checkInventoriCreate.html',
 			controller: 'CheckInventoriCreateController as ctrl'
 		})
 		
 	})