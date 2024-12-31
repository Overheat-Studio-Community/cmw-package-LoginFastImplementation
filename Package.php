<?php

namespace CMW\Package\LoginFastImplementation;

use CMW\Manager\Package\IPackageConfig;
use CMW\Manager\Package\PackageMenuType;

class Package implements IPackageConfig
{
    public function name(): string
    {
        return 'LoginFastImplementation';
    }

    public function version(): string
    {
        return '0.0.1';
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
            new PackageMenuType(
                icon: 'fas fa-user-lock',
                title: 'LoginFast',
                url: 'loginfast-implementation/settings',
                permission: 'loginfastimplementation.manage'
            ),
        ];
    }

    public function requiredPackages(): array
    {
        return ['Core', 'OverApi'];
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
