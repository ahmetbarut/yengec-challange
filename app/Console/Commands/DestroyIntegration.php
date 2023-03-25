<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DestroyIntegration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:destroy-integration {--id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Var olan bir entegrasyonu siler';

    public function __construct(protected \App\Repositories\IntegrationRepository $integrationRepository)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $id = $this->option('id') ?? $this->ask('Integrations ID?');

        if (is_null($id)){
            $integrations = $this->integrationRepository->list(
                columns: ['id', 'name', 'marketplace'],
            );

            $this->table(['id', 'name', 'marketplace'], $integrations);

            $choice = $this->ask('Integrations ID?');

            $id = $choice;
        }

        if (!is_numeric($id)) {
            $this->error('Integration ID only number');

            return Command::FAILURE;
        }

        $integration = $this->integrationRepository->find($id);

        if (!$integration) {
            $this->error('Integration not found');

            return Command::FAILURE;
        }

        $integration->delete();

        $this->info('Integration deleted');

        return Command::SUCCESS;
    }
}
