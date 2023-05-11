<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class crearadmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:crearadmin {usuario} {clave}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new \App\Models\Admin();
        $user->password = \Hash::make($this->argument('clave'));
        $user->email = $this->argument('usuario').'@example.com';
        $user->name = $this->argument('usuario');
        $user->save();
    }
}
