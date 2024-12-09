<?php

namespace frontend\modules\seo\models;

use backend\modules\seo\models\MetaTag as backendMetaTag;
use common\models\Status;
use Yii;

class MetaTag
{
    const TITLE = 'title';

    const DESCRIPTION = 'description';

    const KEYWORDS = 'keywords';

    const OG_TITLE = 'og:title';

    const OG_DESCRIPTION = 'og:description';

    const OG_TYPE = 'og:type';

    const OG_SITENAME = 'og:sitename';

    const OG_IMAGE = 'og:image';

    const OG_URL = 'og:url';

    /**
     * Название параметра для установки видимости заголовка h1.
     * Пример:
     * 
     * В шаблоне
     * ```
     * Yii::$app->view->params['MetaTag::IS_H1_HIDDEN'] = true;
     * ```
     * В представлении
     * ```
     * $this->params['MetaTag::IS_H1_HIDDEN'] = true
     * ```
     */
    const IS_H1_HIDDEN = 'isH1Hidden';

    
    /**
     * Название параметра для установки видимости сниппета текстового описания.
     * Пример:
     * 
     * В шаблоне
     * ```
     * Yii::$app->view->params['MetaTag::IS_DESCRIPTION_TEXT_HIDDEN'] = true;
     * ```
     * В представлении
     * ```
     * $this->params['MetaTag::IS_DESCRIPTION_TEXT_HIDDEN'] = true
     * ```
     */
    const IS_DESCRIPTION_TEXT_HIDDEN = 'isDescriptionHidden';

    /**
     * Название параметра для заголовка h1 по-умолчанию (если не указан).
     * Пример:
     * 
     * В шаблоне
     * ```
     * Yii::$app->view->params['MetaTag::H1_DEFAULT'] = "Заголовок страницы h1";
     * ```
     * В представлении
     * ```
     * $this->params['MetaTag::H1_DEFAULT'] = "Заголовок страницы h1";
     * ```
     */
    const H1_DEFAULT = 'h1_default';

    /**
     * Содержит выборку свойств страницы по текущему url
     * @var backendMetaTag
     */
    protected $seoTags;

    /**
     * Содержит выборку meta-тегов страницы по текущему url
     */
    protected $metaTags;

    /**
     * Содержит выборку meta-свойств страницы (например OpenGraph) по текущему url
     */
    protected $metaProperties;

    public function __construct()
    {
        $this->seoTags = $this->getPropertiesByCurrentUrl();
        $this->metaTags = array_keys(self::getPageMetaTagsArray());
        $this->metaProperties = array_keys(self::getPageMetaPropertiesArray());
    }

    /**
     * Устанавливает значение заголовка h1.
     * Если в БД имеется запись для текущего url - будет использована данная запись,
     * если запись отсутствует - заголовок будет сгенерирован 
     *
     * 
     */
    public function setH1Title()
    {
        // if (!Yii::$app->view->params[self::IS_H1_HIDDEN]) {
            if ($this->seoTags !== null) {
                if ($this->seoTags->h1_text) {
                    return '<h1>' . $this->seoTags->h1_text . '</h1>';
                } else {
                    return '<h1>' . $this->setDefaultH1Title() . '</h1>';
                }
            } else {
                return '<h1>' . $this->setDefaultH1Title() . '</h1>';
            }
        // }
    }

    /**
     * Возвращает сниппет с текстовым описанием страницы при наличии в БД
     *
     */
    public function setDescriptionSnippet()
    {
        // if (!Yii::$app->view->params[self::IS_DESCRIPTION_TEXT_HIDDEN]) {
            if ($this->seoTags !== null) {
                if ($this->seoTags->description_text) {
                    return $this->seoTags->description_text;
                }
            }
        // }
    }

    /**
     * Устанавливает значения meta-свойств по текущему url 
     *
     * @return void
     */
    public function setMetaTags()
    {
        if ($this->seoTags !== null) {   

            foreach($this->metaTags as $tag) {
                if (static::validateMetaTag($tag)) {
                    if ($tag === self::TITLE) {
                        $this->setPageTitle();
                    } else {
                        $this->setMetaTag($tag);
                    }
                }
            }

            foreach($this->metaProperties as $property) {
                if (static::validateMetaProperty($property)) {
                   $this->setMetaProperty($property);
                }
            }
        } else {
            $this->setDefaultPageTitle();
            $this->setDefaultMetaTag();
        }

    }

    /**
     * Возвращает массив значений meta-тегов (keywords, description), используемый по-умолчанию (значения указаны в модуле настроек)
     *
     * @return array
     */
    public static function setDefaultMetaTags(): array
    {
        return [
            self::KEYWORDS => Yii::$app->configManager->getItemValue('seoDefaultKeywords'),
            self::DESCRIPTION => Yii::$app->configManager->getItemValue('seoDefaultDescription'),
        ];
    }

    /**
     * Возвращает массив значений мета-тегов
     *
     * @return array
     */
    public static function getPageMetaTagsArray(): array
    {
        return [
            static::TITLE => 'meta_title',
            static::DESCRIPTION => 'meta_description',
            static::KEYWORDS => 'meta_keywords',
        ];
    }

    /**
     * Возвращает массв значений мета-свойств (например для OpenGraph)
     *
     * @return array
     */
    public static function getPageMetaPropertiesArray(): array
    {
        return [
            static::OG_TITLE => 'og_title',
            static::OG_DESCRIPTION => 'og_description',
            static::OG_IMAGE => 'og_image',
            static::OG_SITENAME => 'og_sitename',
            static::OG_TYPE => 'og_type',
            static::OG_URL => 'og_url',
        ];
    }

    /**
     * Проверка корректности установки meta-тэгов
     *
     * @param [string] $tag название тэга
     * @return boolean
     */
    protected static function validateMetaTag(string $tag): bool
    {
        return (in_array($tag, array_keys(static::getPageMetaTagsArray()))) ? true : false;
    }

    /**
     * Проверка корректности установки meta-свойств
     *
     * @param [string] $tag название свойства
     * @return boolean
     */
    protected static function validateMetaProperty(string $tag): bool
    {
        return (in_array($tag, array_keys(static::getPageMetaPropertiesArray()))) ? true : false;
    }

    /**
     * Запрашивает набор свойств для текущего url из БД
     *
     * @return void
     */
    protected function getPropertiesByCurrentUrl()
    {
        return backendMetaTag::find()->where(['status' => Status::STATUS_ACTIVE, 'url' => parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)])->one();
    }

    /**
     * Устанавливает значение заголовка страницы title из БД для текущего url
     *
     */
    protected function setPageTitle()
    {
        Yii::$app->view->title = $this->seoTags->meta_title;
    }

    /**
     * Устанавливает значение заголовка страницы title по-умолчанию
     *
     */
    protected function setDefaultPageTitle()
    {
        if (!isset(Yii::$app->view->title) && empty(Yii::$app->view->title)) {
            Yii::$app->view->title = Yii::$app->request->hostInfo;
        }
    }

    /**
     * Устанавливает значение для одного meta-тэга
     *
     * @param [string] $tag название тэга
     * @return void
     */
    protected function setMetaTag(string $tag)
    {
        $metaTag = self::getPageMetaTagsArray()[$tag];
        if (isset($this->seoTags->$metaTag) && !empty($this->seoTags->$metaTag)) {
            Yii::$app->view->registerMetaTag([
                'name' => $tag,
                'content' => $this->seoTags->$metaTag,
            ], $tag);
        }
    }

    /**
     * Устанавливает значение по-умолчанию для одного тэга.
     * Используется в случае отсуствия значения в БД
     *
     * @return void
     */
    protected function setDefaultMetaTag()
    {
        foreach (self::setDefaultMetaTags() as $tagName => $tagValue) {
            Yii::$app->view->registerMetaTag([
                'name' => $tagName,
                'content' => $tagValue,
            ]);

            // , $tagName
        }
    }

    /**
     * Устанавливает значение для одного meta-свойства
     *
     * @param [string] $property название свойства
     * @return void
     */
    protected function setMetaProperty(string $property)
    {
        $metaProperty = self::getPageMetaPropertiesArray()[$property];

        if (isset($this->seoTags->$metaProperty) && !empty($this->seoTags->$metaProperty)) {
            Yii::$app->view->registerMetaTag([
                'property' => $property,
                'content' => $this->seoTags->$metaProperty,
            ], $metaProperty);
        }
    }

    /**
     * Устанавливает значение заголовка h1 по-умолчанию
     * Проверяет наличие Yii::$app->view->params[self::H1_DEFAULT] и устанавливает его значение при наличии.
     * В случае отсутствия параметра Yii::$app->view->params[self::H1_DEFAULT] будет использовано значение заголовка title
     *
     * @return void
     */
    protected function setDefaultH1Title()
    {
        if (isset(Yii::$app->view->params[self::H1_DEFAULT]) && !empty(Yii::$app->view->params[self::H1_DEFAULT])) {
            return Yii::$app->view->params[self::H1_DEFAULT];
        } else {
            return Yii::$app->view->title;
        }
    }
}