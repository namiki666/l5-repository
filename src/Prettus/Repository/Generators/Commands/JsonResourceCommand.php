<?php
namespace Prettus\Repository\Generators\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Prettus\Repository\Generators\JsonResouceGenerator;
use Prettus\Repository\Generators\FileAlreadyExistsException;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

/**
 * Class ControllerCommand
 * @package Prettus\Repository\Generators\Commands
 * @author Anderson Andrade <contato@andersonandra.de>
 */
class JsonResourceCommand extends Command
{

    /**
     * The name of command.
     *
     * @var string
     */
    protected $name = 'make:json-resource';

    /**
     * The description of command.
     *
     * @var string
     */
    protected $description = 'Create a new Json Resource.';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Json Resource';

    /**
     * ControllerCommand constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the command.
     *
     * @see fire()
     * @return void
     */
    public function handle(){
        $this->laravel->call([$this, 'fire'], func_get_args());
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function fire()
    {
        try {
            
            (new JsonResouceGenerator([
                'name' => $this->argument('name'),
                'force' => $this->option('force'),
            ]))->run();

            $this->info($this->type . ' created successfully.');

        } catch (FileAlreadyExistsException $e) {
            $this->error($this->type . ' already exists!');

            return false;
        }
    }


    /**
     * The array of command arguments.
     *
     * @return array
     */
    public function getArguments()
    {
        return [
            [
                'name',
                InputArgument::REQUIRED,
                'The name of model for which the Json Resource is being generated.',
                null
            ],
        ];
    }


    /**
     * The array of command options.
     *
     * @return array
     */
    public function getOptions()
    {
        return [
            [
                'force',
                'f',
                InputOption::VALUE_NONE,
                'Force the creation if file already exists.',
                null
            ],
        ];
    }
}
