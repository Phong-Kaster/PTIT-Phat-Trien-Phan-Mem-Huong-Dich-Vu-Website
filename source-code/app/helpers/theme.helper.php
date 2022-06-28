<?php 
/**
 * Get the parameter value of the active theme. 
 * With the add of this function, following functions deprecated: 
 *     - active_theme_path(); 
 *     - active_theme_url();
 *     
 * @param  string $param Name of the parameter [idname, path, url]
 * @since v4.1
 * @return string|null         
 */
function active_theme($param)
{
    // Invalid parameter, return null
    return "default";
}
