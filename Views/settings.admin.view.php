<?php

use CMW\Manager\Lang\LangManager;
use CMW\Manager\Security\SecurityManager;
use CMW\Utils\Website;

Website::setTitle("LoginFast - Settings");
Website::setDescription("LoginFast - Settings");

/* @var ?string $key */
?>

<h3><i class="fa-solid fa-user-lock"></i> LoginFast - Settings</h3>

<div class="center-flex mt-5">
    <div class="card flex-content-xl">
        <div class="text-center">
            <h6>
                Settings
            </h6>
        </div>
        <form method="post">
            <?php SecurityManager::getInstance()->insertHiddenToken() ?>
            <div class="mt-2">
                <label for="key">Key :</label>
                <div class="input-group">
                    <i class="fa-solid fa-tag"></i>
                    <input type="text" id="key" name="key" autocomplete="off"
                           value="<?= $key ?>"
                           placeholder="loginfa.st project key" required>
                </div>
                <small>More informations <a href="#" class="text-info">here</a></small>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn-primary w-full mt-2">
                    <?= LangManager::translate('core.btn.save') ?>
                </button>
            </div>
        </form>
    </div>
</div>