<?php

namespace Eurostep\StorageAdapter\Providers;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Eurostep\StorageAdapter\Commands\InstallPackageCommand;

class EurostepStorageServiceProvider extends ServiceProvider
{

    protected $appNamespaces = [
        'application1' => 'Application1',
        'application2' => 'Application2',
        // Add more application namespaces as needed
    ];

    protected $subAppNamespaces = [
        'subapp1' => 'Subapp1',
        'subapp2' => 'Subapp2',
        // Add more sub-application namespaces as needed
    ];

    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/eurostep_storage.php',
            'eurostep_storage'
        );
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/eurostep_storage.php' => config_path('eurostep_storage.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallPackageCommand::class,
            ]);
        }
    }
    
    // ...

    protected function getApplicationName()
    {
        $appName = env('APP_NAME');;

        if (isset($this->appNamespaces[$appName])) {
            return $this->appNamespaces[$appName];
        }

        return 'App';
    }

    protected function getSubApplicationName()
    {
        $subAppName = App::getSubApplicationName();

        if (isset($this->subAppNamespaces[$subAppName])) {
            return $this->subAppNamespaces[$subAppName];
        }

        return '';
    }

}
