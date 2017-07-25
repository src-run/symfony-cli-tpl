<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Bundle\FrameworkBundle\Tests\Command;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Console\Tester\CommandTester;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class CachePruneCommandTest extends TestCase
{
    public function testCommand()
    {
        $this->assertSame(0, $this->getCommandTester()->execute(array()));
    }

    /**
     * @throws \Exception
     *
     * @return CommandTester
     */
    private function getCommandTester()
    {
        $loader = new YamlFileLoader(
            $container = new ContainerBuilder(),
            new FileLocator(__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'app'.DIRECTORY_SEPARATOR.'/config')
        );
        $loader->load('services.yaml');

        return new CommandTester($container->get('app.main')->find('command-name'));
    }
}
