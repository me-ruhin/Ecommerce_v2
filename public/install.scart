<?php
/**
 * This file auto install s-cart, using for S-cart from version 2.1.1
 * @author Naruto <lanhktc@gmail.com>
 */

require __DIR__ . '/../vendor/autoload.php';
$app = include_once __DIR__ . '/../bootstrap/app.php';
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Artisan;

$kernel   = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);
$lang = request('lang') ?? 'en';
app()->setlocale($lang);
if (request()->method() == 'POST' && request()->ajax()) {

    $step = request('step');
    switch ($step) {
        case 'step1':
            $domain            = str_replace('/install.php', '', url()->current());
            $database_host     = request('database_host') ?? '127.0.0.1';
            $database_port     = request('database_port') ?? '3306';
            $database_name     = request('database_name') ?? '';
            $database_user     = request('database_user') ?? '';
            $database_password = request('database_password') ?? '';
            $admin_url         = request('admin_url') ?? '';
        try {
            $api_key = 'base64:' . base64_encode(
                Encrypter::generateKey(config('app.cipher'))
            );
            $getEnv = file_get_contents(base_path() . '/.env.example');
            $getEnv = str_replace('sc_your_domain', $domain, $getEnv);
            $getEnv = str_replace('sc_database_host', $database_host, $getEnv);
            $getEnv = str_replace('sc_database_port', $database_port, $getEnv);
            $getEnv = str_replace('sc_database_name', $database_name, $getEnv);
            $getEnv = str_replace('sc_database_user', $database_user, $getEnv);
            $getEnv = str_replace('sc_database_password', $database_password, $getEnv);
            $getEnv = str_replace('sc_api_key', $api_key, $getEnv);

            if ($admin_url) {
                $getEnv = str_replace('sc_admin', $admin_url, $getEnv);
            }
            $env = fopen(base_path() . "/.env", "w") or die(json_encode(['error' => 1, 'msg' => trans('install.env.error_open')]));
            fwrite($env, $getEnv);
            fclose($env);

        } catch (\Exception $e) {
            echo json_encode(['error' => 1, 'msg' => $e->getMessage()]);
            exit();
        }
            echo json_encode(['error' => 0, 'msg' => trans('install.env.process_sucess')]);
            break;

    case 'step2':
        Artisan::call('migrate --force');
        try {
            \Illuminate\Support\Facades\DB::connection()->getPdo();
        } catch (\Exception $e) {
            echo json_encode(['error' => 1, 'msg' => $e->getMessage()]);
            break;
        }

        echo json_encode(['error' => 0, 'msg' => trans('install.database.process_sucess')]);
        break;

    case 'step3':
        try {
            rename(base_path() . '/public/install.php', base_path() . '/public/install.scart');
        } catch (\Exception $e) {
            echo json_encode(['error' => 1, 'msg' => trans('install.rename_error')]);
            exit();
        }
        echo json_encode(['error' => 0]);
        break;

    default:
        break;
    }
} else {

    $requirements = [
        'PHP >= 7.2.0'                 => version_compare(PHP_VERSION, '7.2.0', '>='),
        'BCMath PHP Extension'         => extension_loaded('bcmath'),
        'Ctype PHP Extension'          => extension_loaded('ctype'),
        'JSON PHP Extension'           => extension_loaded('json'),
        'OpenSSL PHP Extension'        => extension_loaded('openssl'),
        'PDO PHP Extension'            => extension_loaded('pdo'),
        'Tokenizer PHP Extension'      => extension_loaded('tokenizer'),
        'XML PHP extension'            => extension_loaded('xml'),
        'xmlwriter PHP extension'      => extension_loaded('xmlwriter'),
        'Mbstring PHP extension'       => extension_loaded('mbstring'),
        'ZipArchive PHP extension'     => extension_loaded('zip'),
        'GD (optional) PHP extension'  => extension_loaded('gd'),
        'Dom (optional) PHP extension' => extension_loaded('dom'),
    ];

    echo view('install', array(
        'path_lang' => (($lang != 'en') ? "?lang=" . $lang : ""),
        'title'     => trans('install.title'), 'requirements' => $requirements)
    );
    exit();
}
