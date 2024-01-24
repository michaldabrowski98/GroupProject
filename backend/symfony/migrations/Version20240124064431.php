<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240124064431 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creates table quiz_solve';
    }

    public function up(Schema $schema): void
    {
        $this->addSql(
            "CREATE TABLE quiz_solve (
                    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    quiz_id INT UNSIGNED NOT NULL,
                    user_id INT NOT NULL,
                    token VARCHAR(255) UNIQUE NOT NULL,
                    start_date DATETIME DEFAULT CURRENT_TIMESTAMP,
                    end_date DATETIME,
                    FOREIGN KEY (quiz_id) REFERENCES quiz(id),
                    FOREIGN KEY (user_id) REFERENCES user(id)
                )"
        );
    }

    public function down(Schema $schema): void
    {
        $this->addSql("DROP TABLE quiz_solve");
    }
}
