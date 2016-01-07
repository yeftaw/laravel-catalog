<?php

/*
|--------------------------------------------------------------------------
| Detect Active Route
|--------------------------------------------------------------------------
|
| Compare given route with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
function isActiveRoute($route, $output = "active")
{
	$currentRouteName = Route::currentRouteName();

	if (strpos($route, ".") != true)
	{
		$split = explode('.', $currentRouteName);
		$currentRouteName = $split[0];
	}

	if ($currentRouteName == $route) return $output;
}

/*
|--------------------------------------------------------------------------
| Detect Active Routes
|--------------------------------------------------------------------------
|
| Compare given routes with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
function areActiveRoutes(Array $routes, $output = "active")
{
	foreach ($routes as $route)
	{
		$currentRouteName = Route::currentRouteName();

		if (strpos($route, ".") != true)
		{
			$split = explode('.', $currentRouteName);
			$currentRouteName = $split[0];
		}

		if ($currentRouteName == $route) return $output;
	}
}

?>
