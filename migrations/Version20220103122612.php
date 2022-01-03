<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220103122612 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE level_matter (level_id INT NOT NULL, matter_id INT NOT NULL, INDEX IDX_C968FACE5FB14BA7 (level_id), INDEX IDX_C968FACED614E59F (matter_id), PRIMARY KEY(level_id, matter_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE level_student (level_id INT NOT NULL, student_id INT NOT NULL, INDEX IDX_168B8A2C5FB14BA7 (level_id), INDEX IDX_168B8A2CCB944F1A (student_id), PRIMARY KEY(level_id, student_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_entity_level (user_entity_id INT NOT NULL, level_id INT NOT NULL, INDEX IDX_B6D285E881C5F0B9 (user_entity_id), INDEX IDX_B6D285E85FB14BA7 (level_id), PRIMARY KEY(user_entity_id, level_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE level_matter ADD CONSTRAINT FK_C968FACE5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE level_matter ADD CONSTRAINT FK_C968FACED614E59F FOREIGN KEY (matter_id) REFERENCES matter (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE level_student ADD CONSTRAINT FK_168B8A2C5FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE level_student ADD CONSTRAINT FK_168B8A2CCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_entity_level ADD CONSTRAINT FK_B6D285E881C5F0B9 FOREIGN KEY (user_entity_id) REFERENCES user_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_entity_level ADD CONSTRAINT FK_B6D285E85FB14BA7 FOREIGN KEY (level_id) REFERENCES level (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE level_matter');
        $this->addSql('DROP TABLE level_student');
        $this->addSql('DROP TABLE user_entity_level');
    }
}
