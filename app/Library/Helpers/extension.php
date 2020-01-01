<?php  

/*
Render block
 */
if (!function_exists('sc_block_render')) {
    function sc_block_render($nameSpace)
    {
        $fullNameSpace = '\\App\Plugins\Modules\Block\\'.$nameSpace.'\Controllers\\' . $nameSpace.'Controller';
        if (class_exists($fullNameSpace)) {
            $class = (new $fullNameSpace);
            if (method_exists($class, 'render')) {
                return $class->render();
            }
        }
        return false;
    }
}

if (!function_exists('sc_get_all_plugin')) {
    /**
     * Get all class plugin
     *
     * @param   [string]  $group  Extentions,Modules
     * @param   [string]  $code  Payment, Shipping
     *
     * @return  [array] 
     */
    function sc_get_all_plugin($group, $code)
    {
        $group = sc_word_format_class($group);
        $code = sc_word_format_class($code);
        $arrClass = [];
        $dirs = array_filter(glob(app_path() . '/Plugins/' . $group . '/' . $code . '/*'), 'is_dir');
        if ($dirs) {
            foreach ($dirs as $dir) {
                $tmp = explode('/', $dir);
                $nameSpace = '\App\Plugins\\' . $group . '\\' . $code . '\\' . end($tmp);
                $nameSpaceConfig = $nameSpace . '\\AppConfig';
                if (file_exists($dir . '/AppConfig.php') && class_exists($nameSpaceConfig)) {
                    $arrClass[end($tmp)] = $nameSpace;
                }
            }
        }
        return $arrClass;
    }
}

if (!function_exists('sc_get_all_plugin_actived')) {
    /**
     * Get all class plugin actived
     *
     * @param   [string]  $group  Extentions,Modules
     * @param   [string]  $code  Payment, Shipping
     *
     * @return  [array] 
     */
    function sc_get_all_plugin_actived($group, $code)
    {
        $group = sc_word_format_class($group);
        $code = sc_word_format_class($code);
        
        $pluginsActived = [];
        $allPlugins = sc_get_all_plugin($group, $code);
        if(count($allPlugins)){
            foreach ($allPlugins as $keyPlugin => $plugin) {
                if(sc_config($keyPlugin) && sc_config($keyPlugin)['value'] == 1){
                    $pluginsActived[$keyPlugin] = $plugin;
                }
            }
        }
        return $pluginsActived;
    }
}


    /**
     * Get namespace extension controller
     *
     * @param   [string]  $code  Shipping, Payment,..
     * @param   [string]  $key  Paypal,..
     *
     * @return  [array] 
     */

    if (!function_exists('sc_get_class_extension_controller')) {
        function sc_get_class_extension_controller($code, $key){

            $code = sc_word_format_class($code);
            $key = sc_word_format_class($key);

            $nameSpace = sc_get_extension_namespace($code, $key);
            $nameSpace = $nameSpace . '\Controllers\\' . $key . 'Controller';

            return $nameSpace;
        }
    }


    /**
     * Get namespace extension config
     *
     * @param   [string]  $code  Shipping, Payment,..
     * @param   [string]  $key  Paypal,..
     *
     * @return  [array] 
     */
    if (!function_exists('sc_get_class_extension_config')) {
        function sc_get_class_extension_config($code, $key){

            $code = sc_word_format_class($code);
            $key = sc_word_format_class($key);

            $nameSpace = sc_get_extension_namespace($code, $key);
            $nameSpace = $nameSpace . '\AppConfig';

            return $nameSpace;
        }
    }


    /**
     * Get namespace module config
     *
     * @param   [string]  $code  Cms, Block,..
     * @param   [string]  $key  Content,..
     *
     * @return  [array] 
     */
    if (!function_exists('sc_get_class_module_config')) {
        function sc_get_class_module_config($code, $key){

            $code = sc_word_format_class($code);
            $key = sc_word_format_class($key);

            $nameSpace = sc_get_module_namespace($code, $key);
            $nameSpace = $nameSpace . '\AppConfig';

            return $nameSpace;
        }
    }


    /**
     * Get namespace module controller
     *
     * @param   [string]  $code  Cms, Block,..
     * @param   [string]  $key  Content,..
     *
     * @return  [array] 
     */

    if (!function_exists('sc_get_class_module_controller')) {
        function sc_get_class_module_controller($code, $key){

            $code = sc_word_format_class($code);
            $key = sc_word_format_class($key);

            $nameSpace = sc_get_module_namespace($code, $key);
            $nameSpace = $nameSpace . '\Controllers\\' . $key . 'Controller';

            return $nameSpace;
        }
    }


    /**
     * Get namespace module
     *
     * @param   [string]  $code  Block, Cms,..
     * @param   [string]  $key  Content,..
     *
     * @return  [array] 
     */
    if (!function_exists('sc_get_module_namespace')) {
        function sc_get_module_namespace($code, $key)
        {
            $code = sc_word_format_class($code);
            $key = sc_word_format_class($key);
            $nameSpace = '\App\Plugins\Modules\\'.$code.'\\' . $key;
            return $nameSpace;
        }
    }

    /**
     * Get namespace extension
     *
     * @param   [string]  $code  Payment, shipping,..
     * @param   [string]  $key  Paypal, Cash,...
     *
     * @return  [array] 
     */
    if (!function_exists('sc_get_extension_namespace')) {
        function sc_get_extension_namespace($code, $key)
        {
            $code = sc_word_format_class($code);
            $key = sc_word_format_class($key);
            $nameSpace = '\App\Plugins\Extensions\\'.$code.'\\' . $key;
            return $nameSpace;
        }
    }