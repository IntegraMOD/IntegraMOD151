<?php
// This file will be deleted soon and is only for files that haven't been cleansed yet.
$phpEx = "php";

if (!function_exists('im160_posix_pattern'))
{
	function im160_posix_pattern($pattern, $ignore_case = false)
	{
		$pattern = is_scalar($pattern) ? (string) $pattern : '';
		$delim = chr(1);
		return $delim . str_replace($delim, '\\' . $delim, $pattern) . $delim . ($ignore_case ? 'iD' : 'D');
	}
}

if (!function_exists('im160_posix_replacement'))
{
	function im160_posix_replacement($replacement)
	{
		$replacement = is_scalar($replacement) ? (string) $replacement : '';
		$replacement = str_replace('$', '\\$', $replacement);
		return preg_replace('/\\\\([0-9])/', '$$1', $replacement);
	}
}

if (!function_exists('count_safe'))
{
	function count_safe($value, $mode = 0)
	{
		if (is_array($value) || (is_object($value) && ($value instanceof Countable)))
		{
			return count($value, $mode);
		}
		return 0;
	}
}
?>