<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240124065419 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates quiz_solve_answer table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE quiz_solve_answer (
            id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            quiz_solve_id INT UNSIGNED NOT NULL, 
            participant_name VARCHAR(255) NOT NULL,
            answer_id INT UNSIGNED NOT NULL,
            FOREIGN KEY (quiz_solve_id) REFERENCES quiz_solve(id),
            FOREIGN KEY (answer_id) REFERENCES answer(id)
        )');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE quiz_solve_answer');
    }
}
