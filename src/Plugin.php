<?php

namespace tinybeans\easyform;

use Craft;
use craft\base\Model;
use craft\base\Plugin as BasePlugin;
use tinybeans\easyform\models\Settings;

/**
 * Easy Form plugin
 *
 * @method static Plugin getInstance()
 * @method Settings getSettings()
 * @author tinybeans <info@tinybeans.dev>
 * @copyright tinybeans
 * @license https://craftcms.github.io/license/ Craft License
 */
class Plugin extends BasePlugin
{
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    public static function config(): array
    {
        return [
            'components' => [
                // Define component configs here...
            ],
        ];
    }

    public function init()
    {
        parent::init();

        // Defer most setup tasks until Craft is fully initialized
        Craft::$app->onInit(function() {
            $this->attachEventHandlers();
            // ...
        });
    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('easy-form/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {
    }
}
