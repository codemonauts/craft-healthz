<?php

namespace codemonauts\healthz;

use yii\base\BootstrapInterface;
use yii\web\Application;
use yii\web\Response;
use Craft;

class Healthz extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public function __construct($id, $parent = null, array $config = [])
    {
        Craft::setAlias('@modules/healthz', $this->getBasePath());
        $this->controllerNamespace = 'modules\healthz\controllers';

        parent::__construct($id, $parent, $config);
    }

    /**
     * @inheritDoc
     */
    public function bootstrap($app)
    {
        if ($app instanceof Application && $app->getRequest()->getPathInfo() === 'healthz') {

            $error = false;

            $response = $app->getResponse();
            $response->format = Response::FORMAT_RAW;

            try {

                $db = $app->getDb();
                $command = $db->createCommand('select 1');
                $command->execute();

                $cache = $app->getCache();
                $cache->set('healthz', true);

            } catch (\Exception $e) {
                $error = true;
            }

            if (!$error) {
                $response->content = 'Ok';
                $response->statusCode = 200;
            } else {
                $response->content = 'Not Ok';
                $response->statusCode = 503;
            }

            $app->end(0, $response);
        }
    }
}
