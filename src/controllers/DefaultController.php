<?php
/**
 * @link https://github.com/black-lamp/yii2-email-templates
 * @copyright Copyright (c) Vladimir Kuprienko
 * @license BSD 3-Clause License
 */

namespace bl\emailTemplates\controllers;

use Yii;
use yii\base\Exception;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;

use bl\emailTemplates\models\forms\CreateForm;
use bl\emailTemplates\models\forms\EditForm;
use bl\emailTemplates\models\forms\TemplateForm;
use bl\emailTemplates\models\entities\EmailTemplate;
use bl\emailTemplates\EmailTemplates;
use bl\emailTemplates\providers\LanguageProviderInterface;

/**
 * Default controller for the `EmailTemplatesModule` module
 *
 * @author Vladimir Kuprienko <vldmr.kuprienko@gmail.com>
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
    public function __construct($id, EmailTemplates $module, LanguageProviderInterface $languageProvider,  $config = [])
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
            'templates' => $templates,
            'language' => $this->_languageProvider->getDefault()
        ]);
    }

    /**
     * Method for rendering form for create and edit of template
     *
     * @param TemplateForm $form
     * @param string $view
     * @return string
     */
    protected function renderForm($form, $view)
    {
        $errors = [];
        if(Yii::$app->request->isPost) {
            $form->load(Yii::$app->request->post());
            if(!$form->save()) {
                $errors = $form->getErrors();
            }
        }

        $currentLanguage = [
            $form->languageId => $this->_languageProvider->getNameByID($form->languageId)
        ];

        return $this->render($view, [
            'model' => $form,
            'errors' => $errors,
            'currentLanguage' => $currentLanguage
        ]);
    }

    /**
     * Creation of template
     *
     * @param integer $languageId
     * @return string
     * @throws Exception
     */
    public function actionCreate($languageId)
    {
        $createForm = new CreateForm(['languageId' => $languageId]);
        return $this->renderForm($createForm, 'create');
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
        $editForm = new EditForm([
            'templateId' => $templateId,
            'languageId' => $languageId
        ]);
        return $this->renderForm($editForm, 'edit');
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
