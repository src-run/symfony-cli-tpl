<?php

/*
 * This file is part of the `src-run/simplex-tergum` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\ExampleCommand\Command;

use SR\Console\Output\Style\Style;
use SR\Console\Output\Style\StyleAwareTrait;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class ExampleCommand extends Command
{
    use StyleAwareTrait;

    /**
     * @var string
     */
    const COMMAND_NAME = 'command-name';

    /**
     * configure command
     */
    protected function configure()
    {
        $this
            ->setName(self::COMMAND_NAME)
            ->setDescription('command desc')
            ->setDefinition([
                new InputOption('option', ['o'], InputOption::VALUE_REQUIRED,
                    'option desc'),

                new InputArgument('argument', InputArgument::IS_ARRAY,
                    'argument desc'),
            ]);
    }

    /**
     * @param InputInterface  $input
     * @param OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->setStyle(new Style($input, $output));
        $this->io->applicationTitle($this->getApplication());

        $this->io->success('All operations completed successfully');

        return 0;
    }
}
