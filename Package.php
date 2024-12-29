<?php

namespace CMW\Package\LoginFastImplementation;

use CMW\Manager\Package\IPackageConfig;

class Package implements IPackageConfig
{
    public function name(): string
    {
        return 'LoginFastImplementation';
    }

    public function version(): string
    {
        return '1.0.0';
    }

    public function authors(): array
    {
        return ['OverheatStudio'];
    }

    public function isGame(): bool
    {
        return false;
    }

    public function isCore(): bool
    {
        return false;
    }

    public function menus(): ?array
    {
        return [
            //TODO Settings
        ];
    }

    public function requiredPackages(): array
    {
        return ['Core'];
    }

    /**
     * @return bool
     */
    public function uninstall(): bool
    {
        // Return true, we don't need other operations for uninstall.
        return false;
    }
}
