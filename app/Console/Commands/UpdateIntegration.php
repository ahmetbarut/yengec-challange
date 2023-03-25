<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateIntegration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-integration {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Var olan bir entegrasyonu günceller';

    public function __construct(protected \App\Repositories\IntegrationRepository $integrationRepository)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $integrations = $this->integrationRepository->list(
            columns: ['id', 'name', 'marketplace'],
        );

        if (is_null(($integrationId = $this->option('id')))) {
            $this->table(['id', 'name', 'marketplace'], $integrations);

            $choice = $this->ask('Integrations ID?');

            if (!is_numeric($choice)) {
                $this->error('Integration ID only number');

                return Command::FAILURE;
            }

        } else {
            $choice = $integrationId;
        }

        $integration = $this->integrationRepository->find($choice);

        if (!$integration) {
            $this->error('Integration not found');

            return Command::FAILURE;
        }

        $name = $this->ask('Name', $integration->name);

        $data = [
            'name' => $name,
            'marketplace' => $this->choice('Marketplace?', ['n11', 'gittigidiyor'], $integration->marketplace),
        ];

        $password = $this->secret('Password? if you dont want to change password, leave it blank');

        if ($password !== null){
            $data['password'] = $password;
        }

        try {
            $integration->update($data);
        }catch (\Exception $exception){
            $this->error($exception->getMessage());

            return Command::FAILURE;
        }

        $this->info('Integration updated');

        $this->table(['id', 'name', 'marketplace'], [$integration->only(['id','name', 'marketplace'])]);

        return Command::SUCCESS;
    }
}
