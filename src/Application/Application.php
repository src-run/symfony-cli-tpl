<?php

/*
 * This file is part of the `src-run/serferals` project.
 *
 * (c) Rob Frawley 2nd <rmf@src.run>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

namespace SR\ExampleCommand\Application;

use SR\ExampleCommand\Command\ExampleCommand;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;

class Application extends BaseApplication
{
    /**
     * @var string
     */
    private $authorName;

    /**
     * @var string
     */
    private $authorLink;

    /**
     * @var string
     */
    private $licenseName;

    /**
     * @var string
     */
    private $licenseLink;

    /**
     * @param string $name
     * @param string $vers
     * @param string $authorName
     * @param string $authorLink
     * @param string $licenseName
     * @param string $licenseLink
     */
    public function __construct(string $name, string $vers, string $authorName, string $authorLink, string $licenseName, string $licenseLink)
    {
        parent::__construct($name, $vers);

        $this->authorName  = $authorName;
        $this->authorLink  = $authorLink;
        $this->licenseName = $licenseName;
        $this->licenseLink = $licenseLink;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->authorName;
    }

    /**
     * @return string
     */
    public function getAuthorEmail(): string
    {
        return $this->authorLink;
    }

    /**
     * @return string
     */
    public function getLicense(): string
    {
        return $this->licenseName;
    }

    /**
     * @return string
     */
    public function getLicenseLink(): string
    {
        return $this->licenseLink;
    }

    /**
     * @return null|string
     */
    public function getGitHash(): ?string
    {
        $gitCommit = '@git-commit@';

        if ('@'.'git-commit@' !== $gitCommit) {
            return substr($gitCommit, 0, 7);
        }

        return null;
    }

    /**
     * @return string
     */
    public function getLongVersion(): string
    {
        $version = sprintf('%s by <comment>%s \<%s></comment>', parent::getLongVersion(), $this->getAuthor(), $this->getAuthorEmail());

        if (null !== ($hash = $this->getGitHash())) {
            $version .= sprintf(' (%s)', $hash);
        }

        return $version;
    }

    /**
     * Overridden so that the application does not expect the command
     * name to be the first argument.
     *
     * @return InputDefinition
     */
    public function getDefinition(): InputDefinition
    {
        $inputDefinition = parent::getDefinition();
        $inputDefinition->setArguments();

        return $inputDefinition;
    }

    /**
     * Overridden so the command name doesn't need to be specified on
     * the cli, it is instead provided here nativly.
     *
     * @param InputInterface $input
     *
     * @return string The command name
     */
    protected function getCommandName(InputInterface $input): string
    {
        return ExampleCommand::COMMAND_NAME;
    }
}
