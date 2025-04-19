<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HashExistingPasswords extends Command
{
    protected $signature = 'passwords:hash';
    protected $description = 'Hash all existing plaintext passwords in the users table';

    public function handle()
    {
        // Getting all users with plaintext passwords 
        $users = User::where('password', 'NOT LIKE', '$2y$%')->get();

        if ($users->isEmpty()) {
            $this->info('No plaintext passwords found to hash.');
            return;
        }

        $this->info('Found '.$users->count().' users with plaintext passwords.');

        if ($this->confirm('Do you want to hash these passwords?', true)) {
            $bar = $this->output->createProgressBar($users->count());

            foreach ($users as $user) {
                $user->forceFill([
                    'password' => Hash::make($user->password)
                ])->save();
                $bar->advance();
            }

            $bar->finish();
            $this->info("\nAll passwords have been hashed successfully!");
        }
    }
}
