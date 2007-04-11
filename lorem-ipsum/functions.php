<?php
if ( function_exists('register_sidebar') )
{
register_sidebar(array('name'=>'sidebar-alternate'));
register_sidebar(array('name'=>'sidebar-primary'));
}
?>