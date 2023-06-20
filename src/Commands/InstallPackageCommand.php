<?php

namespace Eurostep\StorageAdapter\Commands;

use Illuminate\Console\Command;
use Eurostep\StorageAdapter\EurostepStorageAdapter;

class InstallPackageCommand extends Command
{
    protected $signature = 'package:install';

    protected $description = 'Install the Eurostep Storage Adapter package';

    public function handle()
    {
        $adapterName = env('APP_NAME');
        $adapter = new EurostepStorageAdapter($adapterName);
        $adapter->configure();

        $this->info('Eurostep Storage Adapter package installed successfully.');
    }

    protected function getApplicationName()
    {
        // Assuming you have a method to retrieve the current application name
        // You can replace this with your actual logic to get the application name
        return env('APP_NAME');
    }
}
