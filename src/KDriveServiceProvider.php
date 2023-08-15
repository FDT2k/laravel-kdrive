<?php

namespace Infomaniak\KDrive;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;

class KDriveServiceProvider extends ServiceProvider
{
    /**
     * Extend Storage with the kDrive driver.
     */
    public function boot()
    {
        Storage::extend('kdrive', function ($app, $config) {
            $adapter = new KDriveAdapter(
                $config['id'],
                $config['username'],
                $config['password'],
                $config['prefix']
            );
            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
    }
}
