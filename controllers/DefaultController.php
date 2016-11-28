<?php
namespace bl\emailTemplates\controllers;

use Yii;
use yii\base\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

use bl\emailTemplates\entities\EmailTemplate;
use bl\emailTemplates\entities\EmailTemplateTranslation;
use bl\emailTemplates\providers\LanguageProviderInterface;

/**
 * Default controller for the `EmailTemplatesModule` module
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
 * @link https://github.com/black-lamp/yii2-email-templates
 * @license https://opensource.org/licenses/GPL-3.0 GNU Public License
 *
 */
class DefaultController extends Controller
{
    /**
     * @inheritdoc
     */
    public $defaultAction = 'list';

    /**
     * Rendering list of templates
     *
     * @return string
     */
    public function actionList()
    {
        $templates = EmailTemplate::find()->all();

        return $this->render('list', [
            'templates' => $templates
        ]);
    }

    /**
     * Creation of template
     *
     * @param null|integer $languageId
     * @return string
     * @throws Exception
     */
    public function actionCreate($languageId = null)
    {
        $template = new EmailTemplate();
        $translation = new EmailTemplateTranslation();
        $errors = [];

        if(Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            $template->load($data);
            $translation->load($data);

            if($template->validate()) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $template->save();
                    $translation->template_id = $template->id;

                    if($translation->validate()) {
                        $translation->save();
                        $transaction->commit();

                        return $this->redirect(Url::toRoute('list'));
                    }
                }
                catch (Exception $ex) {
                    $transaction->rollBack();
                    throw  $ex;
                }
            }

            $errors = array_merge($template->getErrors(), $translation->getErrors());
        }

        /** @var LanguageProviderInterface $provider */
        $provider = $this->module->container->get('backend\bl\providers\LanguageProviderInterface');
        $languages = $provider->getLanguages();

        $current_language = null;
        if ($languageId == null) {
            reset($languages);
            $current_language = [key($languages) => current($languages)];
        }
        else {
            $current_language = [$languageId => $languages[$languageId]];
        }

        return $this->render('create', [
            'template' => $template,
            'translation' => $translation,
            'errors' => $errors,

            'languages' => $languages,
            'current_language' => $current_language
        ]);
    }

    /**
     * Editing of template
     *
     * @param integer $templateId
     * @param null|integer $languageId
     * @return string
     * @throws Exception
     */
    public function actionEdit($templateId, $languageId = null)
    {
        $template = EmailTemplate::findOne($templateId);
        $translation = null;
        $errors = [];

        if($languageId != null) {
            $translation = EmailTemplateTranslation::findOne([
                'template_id' => $templateId,
                'language_id' => $languageId
            ]);
        }

        if(Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            $template->load($data);
            $translation->load($data);

            if($template->validate() && $translation->validate()) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    $template->save();
                    $translation->save();
                    $transaction->commit();

                    return $this->redirect(Url::toRoute('list'));
                }
                catch (Exception $ex) {
                    $transaction->rollBack();
                    throw  $ex;
                }
            }

            $errors = array_merge($template->getErrors(), $translation->getErrors());
        }

        /** @var LanguageProviderInterface $provider */
        $provider = $this->module->container->get('backend\bl\providers\LanguageProviderInterface');
        $languages = $provider->getLanguages();

        $current_language = null;
        if ($languageId == null) {
            reset($languages);
            $current_language = [key($languages) => current($languages)];
        }
        else {
            $current_language = [$languageId => $languages[$languageId]];
        }

        if($languageId == null) {
            $translation = EmailTemplateTranslation::findOne([
                'template_id' => $templateId,
                'language_id' => key($current_language)
            ]);
        }

        if($translation == null) {
            $translation = new EmailTemplateTranslation();
            $translation->template_id = $templateId;
            $translation->language_id = key($current_language);
        }

        return $this->render('edit', [
            'template' => $template,
            'translation' => $translation,
            'errors' => $errors,

            'languages' => $languages,
            'current_language' => $current_language
        ]);
    }

    /**
     * Removing of template
     *
     * @param integer $templateId
     * @return Response
     */
    public function actionDelete($templateId)
    {
        if($template = EmailTemplate::findOne($templateId)) {
            $template->delete();
        }

        return $this->redirect(Url::toRoute('list'));
    }
}
