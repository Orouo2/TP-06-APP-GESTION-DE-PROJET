<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250416114929 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE issue ADD status SMALLINT NOT NULL');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EEFEA08FFB');
        $this->addSql('DROP INDEX IDX_2FB3D0EEFEA08FFB ON project');
        $this->addSql('ALTER TABLE project ADD `key` VARCHAR(10) NOT NULL, DROP key_code, CHANGE lead_user_id lead_id INT NOT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE55458D FOREIGN KEY (lead_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_2FB3D0EE4E645A7E ON project (`key`)');
        $this->addSql('CREATE INDEX IDX_2FB3D0EE55458D ON project (lead_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE55458D');
        $this->addSql('DROP INDEX UNIQ_2FB3D0EE4E645A7E ON project');
        $this->addSql('DROP INDEX IDX_2FB3D0EE55458D ON project');
        $this->addSql('ALTER TABLE project ADD key_code VARCHAR(5) NOT NULL, DROP `key`, CHANGE lead_id lead_user_id INT NOT NULL');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EEFEA08FFB FOREIGN KEY (lead_user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2FB3D0EEFEA08FFB ON project (lead_user_id)');
        $this->addSql('ALTER TABLE issue DROP status');
    }
}
