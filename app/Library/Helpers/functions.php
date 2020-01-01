<?php

use App\Models\AdminConfig;
use App\Models\AdminStore;
use App\Models\ShopBlockContent;
use App\Models\ShopLanguage;
use App\Models\ShopLink;
/*
Get extension in group
 */

if (!function_exists('sc_get_extension')) {
    function sc_get_extension($group, $onlyActive = true)
    {
        $group = sc_word_format_class($group);
        return AdminConfig::getExtensionsGroup($group, $onlyActive);
    }
}

/*
Get all block content
 */
if (!function_exists('sc_link')) {
    function sc_link()
    {
        return ShopLink::getGroup();
    }
}

/*
Get all layouts
 */
if (!function_exists('sc_block_content')) {
    function sc_block_content()
    {
        return ShopBlockContent::getLayout();
    }
}

/*
String to Url
 */
if (!function_exists('sc_word_format_url')) {
    function sc_word_format_url($str)
    {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return strtolower(preg_replace(
            array('/[\'\/~`\!@#\$%\^&\*\(\)\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', '/[\s-]+|[-\s]+|[--]+/', '/^[-\s_]|[-_\s]$/'),
            array('', '-', ''),
            strtolower($str)
        ));
    }
}

/*
Config info
 */
if (!function_exists('sc_config')) {
    function sc_config($key = null, $default = null)
    {
        $allConfig = [];
        try {
            $allConfig = AdminConfig::getAll();
        } catch(\Exception $e) {
            //
        }
        if ($key == null) {
            return $allConfig;
        }
        if (!array_key_exists($key, $allConfig)) {
            return $default;
        } else {
            return trim($allConfig[$key]);
        }
    }
}

/*
Store info
 */
if (!function_exists('sc_store')) {
    function sc_store($key = null, $default = null)
    {
        $allStoreInfo = AdminStore::getData() ? AdminStore::getData()->toArray() : [];
        $lang = app()->getLocale();
        $descriptions = $allStoreInfo['descriptions'];
        foreach ($descriptions as $row) {
            if ($lang == $row['lang']) {
                $allStoreInfo += $row;
            }
        }
        if ($key == null) {
            return $allStoreInfo;
        }
        if (!array_key_exists($key, $allStoreInfo)) {
            return $default;
        } else {
            return is_array($allStoreInfo[$key]) ?: trim($allStoreInfo[$key]);
        }
    }
}

/*
url render
 */
if (!function_exists('sc_url_render')) {
    function sc_url_render($string)
    {
        $arrCheckRoute = explode('route::', $string);
        $arrCheckUrl = explode('admin::', $string);

        if (count($arrCheckRoute) == 2) {
            $arrRoute = explode('::', $string);
            if (isset($arrRoute[2])) {
                try {
                    return route($arrRoute[1], $arrRoute[2]);
                } catch(\Exception $e) {
                    sc_report($e->getMessage());
                    return false;
                }  
            } else {
                try {
                    return route($arrRoute[1]);
                } catch(\Exception $e) {
                    sc_report($e->getMessage());
                    return false;
                }                
            }
        }

        if (count($arrCheckUrl) == 2) {
            $string = \Illuminate\Support\Str::start($arrCheckUrl[1], '/');
            $string = config('app.admin_prefix') . $string;
            return url($string);
        }
        return url($string);
    }
}

//Get all language
if (!function_exists('sc_language_all')) {
    function sc_language_all()
    {
        return ShopLanguage::getList();
    }
}

/*
Render language
 */
if (!function_exists('sc_language_render')) {
    function sc_language_render($string)
    {
        $arrCheck = explode('lang::', $string);
        if (count($arrCheck) == 2) {
            return trans($arrCheck[1]);
        } else {
            return trans($string);
        }
    }
}
/*
Create random token
 */
if (!function_exists('sc_html_render')) {
    function sc_html_render($string)
    {
        $string = htmlspecialchars_decode($string);
        return $string;
    }
}

/*
Format class name
 */
if (!function_exists('sc_word_format_class')) {
    function sc_word_format_class($word)
    {
        $word = \Illuminate\Support\Str::camel($word);
        $word = ucfirst($word);
        return $word;
    }
}

/*
Truncates words
 */
if (!function_exists('sc_word_limit')) {
    function sc_word_limit($word, $limit = 20, $arg = '')
    {
        $word = \Illuminate\Support\Str::limit($word, $limit, $arg);
        return $word;
    }
}

/**
 * Clear data
 */
if (!function_exists('sc_clean')) {
    function sc_clean($data = null, $exclude = [], $level_hight = null)
    {
        if ($level_hight) {
            if (is_array($data)) {
                $data = array_map(function ($v) {
                    return strip_tags($v);
                }, $data);
            } else {
                $data = strip_tags($data);
            }
        }
        if (is_array($data)) {
            array_walk($data, function (&$v, $k) use ($exclude, $level_hight) {
                if (is_array($v)) {
                    $v = sc_clean($v, $exclude, $level_hight);
                } else {
                    if ((is_array($exclude) && in_array($k, $exclude)) || (!is_array($exclude) && $k == $exclude)) {
                        $v = $v;
                    } else {
                        $v = htmlspecialchars_decode($v);
                        $v = htmlspecialchars($v, ENT_COMPAT, 'UTF-8');
                    }
                }
            });
        } else {
            $data = htmlspecialchars_decode($data);
            $data = htmlspecialchars($data, ENT_COMPAT, 'UTF-8');
        }
        return $data;
    }
}

/*
Create random token
 */
if (!function_exists('sc_token')) {
    function sc_token($length = 32)
    {
        $token = \Illuminate\Support\Str::random($length);
        return $token;
    }
}

/*
Handle report
 */
if (!function_exists('sc_report')) {
    function sc_report($msg)
    {
        $msg = date('Y-m-d H:i:s').':'.PHP_EOL.$msg.PHP_EOL;
        try{
            if (sc_config('LOG_SLACK_WEBHOOK_URL') || env('LOG_SLACK_WEBHOOK_URL')) {
                \Log::channel('slack')->error($msg);
            }
        }catch(\Exception $e){
            //
        }

        $pathLog = storage_path('logs/handle/'.date('Y-m-d').'.txt');
        $logFile = fopen($pathLog, "a+") or die("Unable to open file!");
        fwrite($logFile, $msg);
        fclose($logFile);
    }
}


/*
Zip file or folder
 */
if (!function_exists('sc_zip')) {
    function sc_zip($source, $destination)
    {
        if (extension_loaded('zip')) {
            if (file_exists($source)) {
                $zip = new \ZipArchive();
                if ($zip->open($destination, \ZIPARCHIVE::CREATE)) {
                    $source = str_replace('\\', '/', realpath($source));
                    if (is_dir($source)) {
                        $iterator = new \RecursiveDirectoryIterator($source);
                        // skip dot files while iterating 
                        $iterator->setFlags(\RecursiveDirectoryIterator::SKIP_DOTS);
                        $files = new \RecursiveIteratorIterator($iterator, \RecursiveIteratorIterator::SELF_FIRST);
                        foreach ($files as $file) {
                            $file = str_replace('\\', '/', realpath($file));
                            if (is_dir($file)) {
                                $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                            } else if (is_file($file)) {
                                $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                            }
                        }
                    } else if (is_file($source)) {
                        $zip->addFromString(basename($source), file_get_contents($source));
                    }
                }
                return $zip->close();
            }
        }
        return false;
    }
}
/*
    Get locale
    */
if (!function_exists('sc_get_locale')) {
    function sc_get_locale()
    {
        return app()->getLocale();
    }
}
