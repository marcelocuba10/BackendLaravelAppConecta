<?php

namespace Modules\Admin\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use DB;

class ApiCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'api:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

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
     * @return mixed
     */
    public function handle()
    {
        \Log::info("cron sin proceso a ejecutar, ejecute la url admin/machines/cron");
    }
}
