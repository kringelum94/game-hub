<?php

namespace App\Console\Commands;

use App\Config;
use App\Helpers\RefreshIgdbToken;
use Illuminate\Console\Command;

class RefreshApiTokenCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-token:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshes the token to the IGDB api';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        RefreshIgdbToken::refresh();
        $this->info('Token was refreshed!');

        return 1;
    }
}
