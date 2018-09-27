<?php

//
// Layout config for the site admin 
//
                                        

$config['layout']['default']['template']    = 'layouts/frontend';
$config['layout']['default']['title']       = 'HandzforHire';
$config['layout']['default']['js_dir']      = 'assets/js/';
$config['layout']['default']['css_dir']     = 'assets/css/';
$config['layout']['default']['img_dir']     = 'assets/images/';
$config['layout']['default']['javascripts'] = array('jquery.min','bootstrap.min','metronic','layout','function','bootstrap-timepicker.min','bootstrap-datepicker','bootstrap-select.min','select2.min');
 
$config['layout']['default']['stylesheets'] = array('bootstrap.min','login','components-md','layout','darkblue','font-awesome.min','style','bootstrap-timepicker.min','datepicker3','bootstrap-select.min','select2','plugins-md','profile');

$config['layout']['default']['description'] = '';
$config['layout']['default']['keywords']    = '';

$config['layout']['default']['http_metas']  = array(
  'Content-Type' => 'text/html; charset=utf-8',
  'viewport'     => 'width=device-width, initial-scale=1.0',
  'author'			 => 'HandzforHire');

?>
