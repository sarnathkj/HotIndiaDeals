//RoutingConfigurationg - Used State Based Routing

DailyDeals.config(function($stateProvider, $urlRouterProvider, $locationProvider) {
  //
  // For any unmatched url, redirect to /home
  $urlRouterProvider.otherwise("/home");
  //
  // Now set up the states
  $stateProvider
    .state('home', {
      url: '/home',
      templateUrl: 'partials/homePage.html',
    })
    .state('signUp', {
    	url: '/signup',
    	templateUrl: 'partials/signUp.html'
    })
    .state('submitDeal', {
      url: '/submit/deal',
      templateUrl: 'partials/submitDeal.html',
      controller: 'submitDealController'
    })
    .state('submitVoucher', {
      url: '/submit/voucher',
      templateUrl: 'partials/submitVoucher.html',
      controller: 'submitVoucherController'
    });
});