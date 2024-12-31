<?php

namespace CMW\Controller\LoginFastImplementation\Admin;

use CMW\Controller\Users\UsersController;
use CMW\Manager\Filter\FilterManager;
use CMW\Manager\Flash\Alert;
use CMW\Manager\Flash\Flash;
use CMW\Manager\Package\AbstractController;
use CMW\Manager\Router\Link;
use CMW\Manager\Views\View;
use CMW\Model\LoginFastImplementation\LoginFastConfigModel;
use CMW\Utils\Redirect;
use JetBrains\PhpStorm\NoReturn;

/**
 * Class: @LoginFastAdminController
 * @package LoginFastImplementation
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/controllers
 */
class LoginFastAdminController extends AbstractController
{
    #[Link("/settings", Link::GET, scope: '/cmw-admin/loginfast-implementation')]
    private function settings(): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'loginfastimplementation.manage');

        $key = LoginFastConfigModel::getInstance()->getKey();

        View::createAdminView('LoginFastImplementation', 'settings')
            ->addVariableList(['key' => $key])
            ->view();
    }

    #[NoReturn] #[Link("/settings", Link::POST, scope: '/cmw-admin/loginfast-implementation')]
    private function settingsPost(): void
    {
        UsersController::redirectIfNotHavePermissions('core.dashboard', 'loginfastimplementation.manage');

        if (!isset($_POST['key'])) {
            Flash::send(Alert::ERROR, 'Error', 'Key is missing');
            Redirect::redirectPreviousRoute();
        }

        $key = FilterManager::filterInputStringPost('key');
        LoginFastConfigModel::getInstance()->updateKey($key);

        Flash::send(Alert::SUCCESS, 'Success', 'Key updated');

        Redirect::redirectPreviousRoute();
    }
}
