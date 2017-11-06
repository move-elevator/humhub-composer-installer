<?php
declare(strict_types=1);

namespace MoveElevator\Composer\Models;

final class Symlink
{
    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $target;

    /**
     * @throws \InvalidArgumentException
     */
    public function __construct(string $source, string $target)
    {
        $this->source = realpath($source);
        if (false === $this->source) {
            throw new \InvalidArgumentException('path to source of symlink could not be find: ' . $source);
        }

        $tempBaseName = basename($target);
        if (true === empty($tempBaseName)) {
            throw new \InvalidArgumentException('no target file given for symlink: ' . $target);
        }

        $this->target = sprintf('%s/%s', realpath(dirname($target)), $tempBaseName);
    }

    public function getSource(): string
    {
        return $this->source;
    }

    public function getTarget(): string
    {
        return $this->target;
    }
}
