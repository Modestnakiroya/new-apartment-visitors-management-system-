<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class RehashPasswords extends Command
{
    protected $signature = 'passwords:rehash';
    protected $description = 'Rehash all user passwords with Bcrypt';

    public function handle()
    {
        $users = User::all();

        foreach ($users as $user) {
            if (Hash::needsRehash($user->password)) {
                $user->password = Hash::make($user->password);
                $user->save();
                $this->info("Rehashed password for user: {$user->email}");
            }
        }

        $this->info('All passwords have been rehashed with Bcrypt.');
        return 0;
    }
}
