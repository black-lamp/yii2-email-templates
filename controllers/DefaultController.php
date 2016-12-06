<?php
namespace bl\emailTemplates\controllers;

use bl\emailTemplates\EmailTemplates;
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
     * @var LanguageProviderInterface
     */
    protected $_languageProvider;

    /**
     * @inheritdoc
     */
    public function __construct($id, EmailTemplates $module, LanguageProviderInterface $languageProvider, $config = [])
    {
        $this->_languageProvider = $languageProvider;
        parent::__construct($id, $module, $config);
    }

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

            if($template->validate()) {
                $transaction = EmailTemplate::getDb()->beginTransaction();
                try {
                    $template->insert();
                    $translation->load($data);
                    $translation->template_id = $template->id;

                    if($translation->validate()) {
                        $translation->insert();
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

        $languages = $this->_languageProvider->getLanguages();

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
        $languages = $this->_languageProvider->getLanguages();

        $current_language = null;
        if ($languageId == null) {
            reset($languages);
            $current_language = [key($languages) => current($languages)];
        }
        else {
            $current_language = [$languageId => $languages[$languageId]];
        }

        $template = EmailTemplate::findOne($templateId);
        $translation = EmailTemplateTranslation::findOne([
            'template_id' => $templateId,
            'language_id' => key($current_language)
        ]);
        $errors = [];

        if($translation == null) {
            $translation = new EmailTemplateTranslation();
            $translation->template_id = $template->id;
            $translation->language_id = key($current_language);
        }

        if(Yii::$app->request->isPost) {
            $data = Yii::$app->request->post();

            $template->load($data);
            $translation->load($data);

            if($template->validate() && $translation->validate()) {
                $transaction = EmailTemplate::getDb()->beginTransaction();
                try {
                    $template->update();
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
