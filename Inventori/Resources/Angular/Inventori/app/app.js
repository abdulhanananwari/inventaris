 var app = angular 
 	.module('InventoriApp', ['ui.router',
 		'Solumax.ErrorInterceptor','Solumax.JwtManager','Solumax.TenantDatabaseConnection',
 		'Solumax.EntityFinder', 'Solumax.FileManager'])

 	.factory('AppFactory', function() {

		var appFactory = {};

		appFactory.moduleId = '20035';

		return appFactory;
	})