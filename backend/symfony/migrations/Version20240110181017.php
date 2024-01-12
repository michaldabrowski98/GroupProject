<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240110181017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create new table Quiz';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE quiz (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            description LONGTEXT,
            author_id INT NOT NULL, 
            FOREIGN KEY (author_id) REFERENCES user(id)          
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE quiz');
    }
}
