black-lamp/email-templates commits history
------------------------------------------

## [2.0.0]
### Added
- Added widgets
- Added models for forms
- Added new method to `bl\emailTemplates\providers\LanguageProviderInterface`
- Added config language provider
- Added new methods to `bl\emailTemplates\data\Template`
- Added tests

### Changed
- Using `Query` instead `ActiveRecord` in `bl\emailTemplates\providers\DbLanguageProvider`
- Active Record models replaced from `bl\emailTemplates\entities` namespace to `bl\emailTemplates\models\entities`
- Component `bl\emailTemplates\components\EmailTemplate` renamed to `TemplateManager`
- Changes in project structure
- Code refactoring

## [1.0.2] - 2016-11-29

- Fixed bug in edit action
- Fixed namespaces in controller

## [1.0.1] - 2016-11-29

- Fixed namespaces in view files

## [1.0.0] - 2016-11-29

- First version of module

## [Development started] - 2016-11-24