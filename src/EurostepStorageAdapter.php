<?php

namespace Eurostep\StorageAdapter;

use Illuminate\Support\Facades\Storage;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\ServiceProvider;

class EurostepStorageAdapter
{
    protected $adapterName;

    public function __construct($adapterName)
    {
        $this->adapterName = $adapterName;
    }

    public function configure()
    {
        $this->publishServiceProvider();
        $this->publishConfiguration();
        $this->setStorageAdapter();
    }

    protected function publishServiceProvider()
    {
        $serviceProvider = app_path('Providers/EurostepStorageServiceProvider.php');
        $this->publishFile(__DIR__.'/../stubs/EurostepStorageServiceProvider.stub', $serviceProvider);
    }

    protected function publishConfiguration()
    {
        $configuration = config_path('eurostep_storage.php');
        $this->publishFile(__DIR__.'/../stubs/eurostep_storage.stub', $configuration);
    }

    protected function publishFile($stubFile, $targetFile)
    {
        if (!file_exists($targetFile)) {
            copy($stubFile, $targetFile);
        }
    }

    protected function setStorageAdapter()
    {
        $adapterConfig = config('eurostep_storage.adapters.'.$this->adapterName);

        if ($adapterConfig) {
            Storage::extend($this->adapterName, function ($app, $config) use ($adapterConfig) {
                $filesystem = $this->createFilesystem($adapterConfig);
                return new FilesystemAdapter($filesystem);
            });
        }
    }

    protected function createFilesystem($adapterConfig)
    {
        // Create and return a new filesystem instance based on the adapter configuration
        // You can use the appropriate Laravel storage adapter here
        // For example, if you're using local storage, use `new Filesystem($adapterConfig['root'])`

        // Example code for local storage
        return new \Illuminate\Filesystem\FilesystemManager($adapterConfig);
    }
}
