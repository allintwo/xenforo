<?php

return function($__templater, array $__vars, array $__options = [])
{
	$__widget = \XF::app()->widget()->widget('demo_portal_view_members_online', $__options)->render();

	return $__widget;
};