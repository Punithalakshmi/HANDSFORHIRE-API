<?php

function include_title($title='')
{
    if (!($layout =& get_layout())) return;

    //echo '<title>' . $layout->get_title() . '</title>';
    $title = (!empty($title))? $title:$layout->get_title();
    echo '<title>' . $title . '</title>';
}

function include_img_path() {
  if (!$layout =& get_layout()) return;
  $CI =& get_instance();

  $img_dir = base_url();
  $img_dir .= $CI->layout->get_img_dir();

  return $img_dir;


}

function include_javascripts()
{
    if (!$layout =& get_layout()) return;
    $CI =& get_instance();

    foreach ($layout->get_javascripts() as $file_name)
    {
        if (preg_match("/^(http)|(https)/i", $file_name)) {
            $href = $file_name;
        } else {
            $href =  base_url();
            $href .= $CI->layout->get_js_dir() ? $CI->layout->get_js_dir() . '/' : '';
            $href .= $file_name . '.js';
        }
        echo '<script type="text/javascript" src="' . $href . '"></script>' . "\n";
    }
}

function include_stylesheets()
{
    if (!$layout =& get_layout()) return;
    $CI =& get_instance();
    
    foreach ($layout->get_stylesheets() as $item)
    {
        if (preg_match("/^(http)|(https)/i", $item['file_name'])) {
            $href = $item['file_name'];
        } else {
        	if (preg_match("/^(http)|(https)/i",$CI->layout->get_css_dir() )) {
        		$href = $CI->layout->get_css_dir() ? $CI->layout->get_css_dir() . '/' : '';
        		$href .= $item['file_name'] . '.css';
        	} else {
            		
            		$href = base_url();
            		$href .= $CI->layout->get_css_dir() ? $CI->layout->get_css_dir() . '/' : '';
            		$href .= $item['file_name'] . '.css';
            }
        }
    
        echo '<link rel="stylesheet" type="text/css"  href="' . $href  . '" media="' . $item['media'] . '"/>' . "\n";
    }
}

function include_metas()
{
    if (!$layout =& get_layout()) return;

    foreach ($layout->get_metas() as $name => $meta_content)
    {
        echo '<meta name="' . $name . '" content="' . $meta_content . '" />' . "\n";
    }
    foreach ($layout->get_http_metas() as $name => $meta_content)
    {
        echo '<meta http-equiv="' . $name . '" content="' . $meta_content . '" />' . "\n";
    }
    foreach ($layout->get_html5_metas() as $meta_content)
    {
        $str = '';
        if(is_array($meta_content))
        {
            $str .= "<meta ";
            foreach ($meta_content as $name => $value) 
            {
               $str .= $name.'="'.$value.'" ';
            }
            $str .= " />\n";
        }
        echo $str;
    }
}

function include_links()
{
    if (!$layout =& get_layout()) return;

    foreach ($layout->get_links() as $arributes)
    {
        $link = '<link ';    
        foreach ($attributes as $name => $value)
        {
            $link .= $name . '="' . $value . '" ';
        }
        $link .= '/>' . "\n";
         
        echo $link;
    }
}

function include_raws()
{
    if (!$layout =& get_layout()) return;

    foreach ($layout->get_raws() as $raw)
    {
        echo $raw . "\n";
    }
}

function &get_layout()
{
    $CI =& get_instance();
        
    if (!isset($CI->layout))
    {
        return false;
    }
    return $CI->layout;
}

/**
* The goal of this function is to display the path of the current view file as a html comment 
* at the first and last line of all view files (not layout files).
* 
* - The helper function should take in a single parameter which is a full path to a view file
* - The function should return an html comment that contains that path relative to the view folder
*/
function get_view_path($path)
{
	
	$CI = & get_instance();

	$appsPath = dirname(dirname(dirname(__FILE__))).'/apps/';

	$appViewParent = basename(dirname($CI->load->_ci_view_path));

	$appPath = ($appsPath . $appViewParent);

	return '<!-- view: ' . str_replace($appPath, '', $path) . '-->';

}





?>
