<?php namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('HomeController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
//$routes->set404Override(function () {
//    return view('backend/404');
//});
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'HomeController::index_front');
$routes->get('info/uptd-cabdin/(:any)', 'HomeController::detail_uptd/$1');
$routes->get('info/opd/(:any)', 'HomeController::detail_opd/$1');
$routes->group('dashboard', ['filter' => 'ceklogin'], function ($routes) {
    $routes->get('/', 'HomeController::index');
    $routes->get('profil', 'HomeController::profil');
    $routes->get('ubah-profil', 'HomeController::ubah_profil');
    $routes->post('update-profil', 'HomeController::update_profil');
    $routes->get('ubah-password', 'HomeController::ubahpw');
    $routes->post('update-password', 'HomeController::update_password');
    $routes->get('log', 'LogController::index');
    $routes->post('log/read', 'LogController::read');
    $routes->post('log/bulk_delete', 'LogController::bulk_delete', ['filter' => 'cekloginAdmin']);

    $routes->group('konfigurasi', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'KonfigurasiController::index');
        $routes->get('edit/(:any)', 'KonfigurasiController::edit/$1');
        $routes->post('update', 'KonfigurasiController::update');
        $routes->post('read', 'KonfigurasiController::read');
    });

    $routes->group('opd', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'OpdController::index');
        $routes->post('read', 'OpdController::read');
        $routes->get('form', 'OpdController::form');
        $routes->post('create', 'OpdController::create');
        $routes->get('edit/(:any)', 'OpdController::edit/$1');
        $routes->post('update', 'OpdController::update');
        $routes->get('detail/(:any)', 'OpdController::detail/$1');
        $routes->get('delete/(:any)', 'OpdController::delete/$1');
        $routes->get('getIDOPD/(:any)', 'OpdController::getIDOPD/$1');
    });

    $routes->group('uptd-cabdin', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'UptdController::index');
        $routes->post('read', 'UptdController::read');
        $routes->get('form', 'UptdController::form');
        $routes->post('create', 'UptdController::create');
        $routes->get('edit/(:any)', 'UptdController::edit/$1');
        $routes->post('update', 'UptdController::update');
        $routes->get('detail/(:any)', 'UptdController::detail/$1');
        $routes->get('delete/(:any)', 'UptdController::delete/$1');
    });

    $routes->group('rekap', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'RekapController::index');
        $routes->post('read', 'RekapController::read');
    });

    $routes->group('pengguna', ['filter' => 'cekloginAdmin'], function ($routes) {
        $routes->get('/', 'PenggunaController::index');
        $routes->get('getViewData', 'PenggunaController::view_data');
        $routes->get('getSearchData', 'PenggunaController::search');
        $routes->post('create', 'PenggunaController::create');
        $routes->get('edit/(:any)', 'PenggunaController::edit/$1');
        $routes->post('update', 'PenggunaController::update');
        $routes->get('delete/(:any)', 'PenggunaController::delete/$1');
    });
});
$routes->get('/syslog', 'LoginController::index');
$routes->post('/syslog/cek_login/', 'LoginController::cek_login');
$routes->get('/syslog/logout/', 'LoginController::logout');

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
