<?php

namespace CMW\Controller\LoginFastImplementation\Api;

use CMW\Controller\OverApi\OverApi;
use CMW\Controller\OverApi\OverExternalApi;
use CMW\Event\LoginFastImplementation\LoginFastSuccessEvent;
use CMW\Manager\Events\Emitter;
use CMW\Manager\Filter\FilterManager;
use CMW\Manager\Package\AbstractController;
use CMW\Manager\Requests\HttpMethodsType;
use CMW\Manager\Router\Link;
use CMW\Model\LoginFastImplementation\LoginFastConfigModel;
use CMW\Type\OverApi\RequestsErrorsTypes;
use JetBrains\PhpStorm\NoReturn;
use function base64_encode;
use function is_null;
use function time;
use const FILTER_SANITIZE_EMAIL;

/**
 * Class: @LoginFastApiController
 * @package LoginFastImplementation
 * @link https://craftmywebsite.fr/docs/fr/technical/creer-un-package/controllers
 */
class LoginFastApiController extends AbstractController
{
    #[NoReturn] #[Link("/", Link::POST, scope: '/api/loginfast', secure: false)] //TODO Add xsrf integration
    private function apiLogin(): void
    {
        //Check client API key
        $apiKey = $this->getClientApiKey();

        //Get client mail
        $mail = $this->getClientPostMail();

        if (!$this->sendLoginFastRequest($apiKey, $mail)) {
            OverApi::returnError(RequestsErrorsTypes::INTERNAL_SERVER_ERROR, ['unable to send request']);
        }

        OverApi::returnData(['status' => 1, 'sender' => $mail, 'timestamp' => time()]);
    }

    #[NoReturn] #[Link("/callback", Link::GET, scope: '/api/loginfast')]
    private function callbackCheck(): void
    {
        $otpKey = $this->getClientOtpKey();
        $apiKey = $this->getClientApiKey();

        $mail = $this->sendLoginFastCallback($otpKey, $apiKey);

        if (!$mail) {
            OverApi::returnError(RequestsErrorsTypes::INTERNAL_SERVER_ERROR, ['unable to send request']);
        }

        Emitter::send(LoginFastSuccessEvent::class, $mail);
        OverApi::returnData(['status' => 1, 'timestamp' => time()]);
    }

    /**
     * @param string $apiKey
     * @param string $mail
     * @return bool
     */
    private function sendLoginFastRequest(string $apiKey, string $mail): bool
    {
        $res = OverExternalApi::send(
            HttpMethodsType::POST,
            'https://dash.loginfa.st/api/send',
            postFields: [
                'mail' => base64_encode($mail),
            ],
            headers: [
                "X-Api-Key: $apiKey",
            ],
            isAssociative: true
        );

        return isset($res['status']) && $res['status'] === 1;
    }

    /**
     * @return string
     */
    private function getClientApiKey(): string
    {
        $key = LoginFastConfigModel::getInstance()->getKey();

        if (is_null($key)) {
            OverApi::returnError(RequestsErrorsTypes::INTERNAL_SERVER_ERROR, ['unable to get API key. Please setup it in the admin panel']);
        }

        return $key;
    }

    /**
     * @return string
     */
    private function getClientPostMail(): string
    {
        if (!isset($_POST['mail'])) {
            OverApi::returnError(RequestsErrorsTypes::WRONG_PARAMS, ['mail is missing']);
        }

        $mail = FilterManager::filterInputStringPost('mail', 255, FILTER_SANITIZE_EMAIL);

        if (!FilterManager::isEmail($mail)) {
            OverApi::returnError(RequestsErrorsTypes::WRONG_PARAMS);
        }

        return $mail;
    }

    /**
     * @return string
     */
    private function getClientOtpKey(): string
    {
        if (!isset($_GET['otp'])) {
            OverApi::returnError(RequestsErrorsTypes::WRONG_PARAMS, ['otp is missing']);
        }

        return FilterManager::filterInputStringGet('otp', 255);
    }

    /**
     * @param string $otpKey
     * @param string $apiKey
     * @return false|string
     * @desc Return mail if success
     */
    private function sendLoginFastCallback(string $otpKey, string $apiKey): false|string
    {
        $res = OverExternalApi::send(
            HttpMethodsType::POST,
            'https://dash.loginfa.st/api/validate',
            postFields: [
                'otp' => $otpKey,
            ],
            headers: [
                "X-Api-Key: $apiKey",
            ],
            isAssociative: true
        );

        if (!isset($res['status']) || $res['status'] !== 1) {
            return false;
        }

        return $res['user']['mail'] ?? false;
    }
}
