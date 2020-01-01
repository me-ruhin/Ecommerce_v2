<?php
$router->group(['prefix' => 'backup'], function ($router) {
    $router->get('/', 'BackupController@index')->name('admin_backup.index');
    $router->post('generate', 'BackupController@generateBackup')->name('admin.backup.generate');
    $router->post('process', 'BackupController@processBackupFile')->name('admin.backup.process');
});
