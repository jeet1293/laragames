<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;

class CreateUserCommand extends Command implements PromptsForMissingInput
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-user-command {name} {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a user from command line';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $email = $this->argument('email');

        if(User::where('email', '=', $email)->count()) {
            $this->fail('User already exist with email '. $email);
        }

        $user = User::factory()
            ->create([
                'name' => $name,
                'email' => $email
            ]);

        $token = $user->createToken('jwt')->plainTextToken;

        $this->info('Token: '. $token);

        return true;
    }
}
