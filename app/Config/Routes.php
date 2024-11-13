<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Statiques::index');
$routes->post('newletter', 'C_newletter::save');
$routes->post('message', 'C_message::save');
$routes->get('/articles', 'Statiques::articles');
$routes->post('/articles', 'Statiques::articles');
$routes->get('/V_articles', 'C_articles::index');
$routes->get('/contact', 'Statiques::contact');
$routes->get('/actualites', 'Statiques::actualites');
$routes->get('/accueil', 'Statiques::accueil');

$routes->get('/cabinet', 'Statiques::cabinet');
$routes->get('/directions', 'Statiques::directions');
$routes->get('/organismes', 'Statiques::organismes');
$routes->get('/sg', 'Statiques::sg');

$routes->get('/energie', 'Statiques::energie');
$routes->get('/petrole', 'Statiques::petrole');
$routes->get('/mines', 'Statiques::mines');
$routes->get('/electricite', 'Statiques::electricite');
$routes->get('/hydrocarbure', 'Statiques::hydrocarbure');
$routes->get('/renouvelable', 'Statiques::renouvelable');
$routes->get('/gaz', 'Statiques::gaz');
$routes->get('/geologie', 'Statiques::geologie');

$routes->get('/autorisations', 'Statiques::autorisations');
$routes->get('/licence', 'Statiques::licence');
$routes->get('/permis', 'Statiques::permis');
$routes->get('/titre', 'Statiques::titre');
$routes->get('/cadastre', 'Statiques::cadastre');

$routes->get('/potentialite', 'Statiques::potentialite');
$routes->get('/transition', 'Statiques::transition');
$routes->get('/appel_offre', 'Statiques::appel_offre');
$routes->get('/contrats', 'Statiques::contrats');
$routes->get('/conventions', 'Statiques::conventions');
$routes->get('/documentation', 'Statiques::documentation');
$routes->get('/lois_decrets_arretes', 'Statiques::lois_decrets_arretes');




// use App\Controllers\Statiques;

// $routes->get('statiques', [Statiques::class, 'index']);
// $routes->get('(:segment)', [Statiques::class, 'afficher']);

