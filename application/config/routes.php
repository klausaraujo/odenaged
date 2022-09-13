<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
#Formularios de Login
$route['default_controller'] = 'login';
$route['login'] = 'login/login';
$route['doLogin'] = 'login/doLogin';

#funciones generales para todos los modulos
$route['curl'] = 'main/curl';
$route['urlCurl'] = 'main/urlCurl';
$route['eventos'] = 'main/eventos';
$route['usuarios'] = 'main/usuarios';
$route['cargarprov'] = 'main/cargarprov';
$route['cargardis'] = 'main/cargardis';
$route['cargarLatLng'] = 'main/cargarLatLng';
$route['fichas'] = 'main/fichas';

#Formularios de Registro y edicion de Eventos
$route['cargarEvento'] = 'eventos/main/cargarEvento';
$route['registrarEvento'] = 'eventos/main/index';
$route['eventosListar'] = 'eventos/main/listar';
$route['editarEvento'] = 'eventos/main/editarEvento';

#Informes
$route['buscaPreliminar'] = 'eventos/informes/preliminar';
$route['buscaComplementario'] = 'eventos/informes/complementario';
$route['borraComplementario'] = 'eventos/informes/borraComplementario';
$route['buscaVersion'] = 'eventos/informes/traeVersion';
$route['buscaIE'] = 'eventos/informes/buscaIE';
$route['registraInforme'] = 'eventos/informes/registrar';
$route['existeAccion'] = 'eventos/informes/existeAccion';
$route['informe'] = 'eventos/informes/informe';
$route['buscaIESPrel'] = 'eventos/informes/buscaIESPrel';
$route['buscaUGELPrel'] = 'eventos/informes/buscaUGELPrel';

#Gestion de Usuarios
$route['perfil'] = 'usuario/perfil';
$route['uploadIMG'] = 'usuario/uploadIMG';
$route['pass'] = 'usuario/password';
$route['buscaDRE'] = 'usuarios/main/buscaDRE';
$route['buscaUGEL'] = 'usuarios/main/buscaUGEL';
$route['permisos'] = 'usuarios/main/permisos';
$route['regusuario'] = 'usuarios/main/registrar';

# Mapas interactivos
$route['mapas'] = 'main/mapasInteractivos';
/**/
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
