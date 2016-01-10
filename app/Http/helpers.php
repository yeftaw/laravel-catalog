<?php

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

function recursiveArrayTable($array)
{
	foreach ($array as $value) {
		$totalChild = count($value->children);
		$nbsp = "";
		for ($i=0; $i < $value->depth; $i++) {
			$nbsp .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		}

		echo "<tr>\n";
		echo "	<td>$nbsp\n";

		if($totalChild > 0)
		{
			echo "		<i class=\"fa fa-caret-down\"></i>&nbsp;&nbsp;\n";
		} else {
			echo "		<i class=\"fa fa-caret-right\"></i>&nbsp;&nbsp;\n";
		}

		echo "		$value->title\n";
		echo "	</td>\n";

		echo "	<td class=\"text-center\">\n";
		echo "		<a href=\"".route('categories.edit', ['categories' => $value->id])."\" type=\"button\" class=\"btn btn-xs btn-warning\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Edit\">\n";
		echo "			<span class=\"glyphicon glyphicon-edit\" aria-hidden=\"true\"></span>\n";
		echo "		</a>";
		echo "		<a href=\"".route('categories.destroy', ['categories' => $value->id])."\" class=\"btn btn-xs btn-danger\" data-delete=\"".csrf_token()."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Delete\">\n";
		echo "			<span class=\"glyphicon glyphicon-remove\" aria-hidden=\"true\"></span>\n";
		echo "		</a>\n";
		echo "	</td>\n";

		echo "<tr>\n";

		recursiveArrayTable($value->children);
	}
}

function recursiveArraySelect($array, $id = null)
{
	foreach ($array as $value) {
		$totalChild = count($value->children);

		$nbsp = "";
		for ($i=0; $i < $value->depth; $i++) {
			$nbsp .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		}

		if (old('id') != null)
		{
			if (old('id') == $value->id)
			{
				echo "<option value=\"$value->id\" selected>$nbsp$value->title</option>";
			} else {
				echo "<option value=\"$value->id\">$nbsp$value->title</option>";
			}
		} else {
			if ($value->id == $id)
			{
				echo "<option value=\"$value->id\" selected>$nbsp$value->title</option>";
			} else {
				echo "<option value=\"$value->id\">$nbsp$value->title</option>";
			}
		}

		recursiveArraySelect($value->children, $id);
	}
}

function recursiveArraySelect2($array, $ids = null)
{
	foreach ($array as $value) {
		$totalChild = count($value->children);

		if(is_array($ids))
		{
			$ids = $ids;
		} else {
			$ids = array($ids);
		}

		if ($ids != null && in_array($value->id, $ids))
		{
			echo "<option value=\"$value->id\" selected>$value->title</option>";
		} else {
			echo "<option value=\"$value->id\">$value->title</option>";
		}

		recursiveArraySelect2($value->children, $ids);
	}
}

?>
