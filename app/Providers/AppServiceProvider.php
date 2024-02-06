<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Yajra\DataTables\Html\Builder;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use ImageKit\ImageKit;
use League\Flysystem\Filesystem;
use TaffoVelikoff\ImageKitAdapter\ImagekitAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ImagekitAdapter::class, function ($app, $config) {
            return new ImagekitAdapter(
                new ImageKit(
                    config('filesystems.disks.imagekit.public_key'),
                    config('filesystems.disks.imagekit.private_key'),
                    config('filesystems.disks.imagekit.endpoint_url')
                )
            );
        });

        Storage::extend('imagekit', function ($app, $config) {
            $adapter = $app->make(ImagekitAdapter::class);
            return new FilesystemAdapter(
                new Filesystem($adapter, $config),
                $adapter,
                $config
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // set DataTable to use vitejs by default
        Builder::useVite();
    }
}