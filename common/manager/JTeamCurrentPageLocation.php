<?php

class JTeamCurrentPageLocation
{
	public function isBackend()
	{
		return defined('WP_BLOG_ADMIN');
	} // end isBackend

	public function isAjax()
	{
		return defined('DOING_AJAX') && DOING_AJAX;
	} // end isAjax
}