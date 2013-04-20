<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "browse";
$route['404_override'] = 'pages/error';

$route['article/(:num)'] = "article/view/$1";
$route['article/(:num)/(:any)'] = "article/view/$1";
$route['browse/(:num)-(:num)-(:num)'] = "browse/date/$1-$2-$3";
$route['author/(:num)'] = "author/view/$1";
$route['series/(:num)'] = "series/view/$1";

$route['search'] = "pages/search";
$route['advsearch'] = "pages/advsearch";
$route['isitivies'] = "pages/isitivies";
$route['about'] = "pages/view/about";
$route['browser'] = "pages/view/browser";
$route['contact'] = "pages/view/contact";
$route['subscribe'] = "pages/view/subscribe";
$route['advertise'] = "pages/view/advertise";
$route['survey'] = "pages/view/survey";

$route['election2012'] = "article/view/7677";

$route['pages/(:any)'] = "pages/view/$1";

/* End of file routes.php */
/* Location: ./application/config/routes.php */