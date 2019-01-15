<?php
namespace app\core;

use yii\i18n\MissingTranslationEvent;
use Yii;
class DbMessageSource extends \yii\i18n\DbMessageSource
{

    static public function handleMissingTranslation(MissingTranslationEvent $event) {

        $model = self::model($event->category);

        $result = $model::getCollection()->update([
            'lang' => $event->language,
        ], [
            '$addToSet' => [
                'messages' => [
                    'message' => $event->message,
                    'translation' => ''
                ]
            ]
        ], ['upsert' => true]);

        if((int)$result > 0) {
            $key = [
                'DB_LOCALES',
                $event->category,
                $event->language,
            ];
            Yii::$app->cache->delete($key);
        }


    }
}