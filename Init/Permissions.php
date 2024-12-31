<?php

namespace CMW\Permissions\LoginFastImplementation;

use CMW\Manager\Permission\IPermissionInit;
use CMW\Manager\Permission\PermissionInitType;

class Permissions implements IPermissionInit
{
    public function permissions(): array
    {
        return [
            new PermissionInitType(
                code: 'loginfastimplementation.manage',
                description: "Manage LoginFast implementation",
            ),
        ];
    }
}
