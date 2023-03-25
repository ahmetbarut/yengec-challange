<?php

namespace App\Console\Commands;

use App\Contracts\IntegrationContract;
use Illuminate\Console\Command;
use Symfony\Component\Console\Command\Command as CommandAlias;

class CreateIntegration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-integration {marketplace?} {name?} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct(protected IntegrationContract $integrationRepository)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $users = \App\Models\User::all('id', 'email');

        $this->table(['id', 'email'], $users->toArray());

        $choice = $this->anticipate('User?', $users->pluck('email')->toArray());

        $user = $users->where(
                is_numeric($choice) ? 'id' : 'email',
                    $choice
            )->first();

        if ($user === null) {
            $this->error('User not found');
            return CommandAlias::FAILURE;
        }

        if (!($name = $this->argument('name'))) {
            $name = $this->ask('Name?');
        }

        if (!($marketplace = $this->argument('marketplace'))) {
            $marketplace = $this->ask('Marketplace?');
        }

        if (!($password = $this->argument('password'))) {
            $password = $this->ask('Password?');
        }

        $integration = $this->integrationRepository->create([
            'marketplace' => $marketplace,
            'name' => $name,
            'password' => $password,
            'user_id' => $user->id,
        ]);

        $this->info('Integration created');

        $this->table(['id', 'marketplace', 'name', 'password', 'user_id'], [
            [
                $integration->id,
                $integration->marketplace,
                $integration->name,
                $integration->password,
                $integration->user_id,
            ]
        ]);

        return Command::SUCCESS;

    }
}
