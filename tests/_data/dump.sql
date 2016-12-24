PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: email_template
DROP TABLE IF EXISTS email_template;
CREATE TABLE email_template (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	"key" STRING (255) NOT NULL UNIQUE
);

-- Table: email_template_translation
DROP TABLE IF EXISTS email_template_translation;
CREATE TABLE email_template_translation (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	template_id INTEGER NOT NULL
	CONSTRAINT "email_template_translation-email_template-PK" REFERENCES email_template (id)
	ON DELETE CASCADE ON UPDATE CASCADE NOT NULL, language_id INTEGER,
	subject STRING,
	body TEXT
);

-- Table: language
DROP TABLE IF EXISTS language;
CREATE TABLE language (
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	name STRING NOT NULL
);
INSERT INTO language (id, name) VALUES (1, 'English');
INSERT INTO language (id, name) VALUES (2, 'Russian');

COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
