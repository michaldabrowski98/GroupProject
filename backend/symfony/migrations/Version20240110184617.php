<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240110184617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table answer';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE answer (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            question_id INT UNSIGNED NOT NULL, 
            content LONGTEXT NOT NULL,
            is_correct TINYINT DEFAULT 0,
            FOREIGN KEY (question_id) REFERENCES question(id)          
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE answer');
    }
}
