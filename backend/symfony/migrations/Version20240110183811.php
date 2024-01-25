<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240110183811 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table question';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE question (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            quiz_id INT UNSIGNED NOT NULL, 
            image VARCHAR(255) NOT NULL,
            content LONGTEXT NOT NULL,
            FOREIGN KEY (quiz_id) REFERENCES quiz(id)          
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE question');
    }
}
