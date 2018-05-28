<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180527082740 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE mc_admin (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(254) NOT NULL, password VARCHAR(254) NOT NULL, email VARCHAR(254) NOT NULL, is_active TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mc_blog (id INT UNSIGNED AUTO_INCREMENT NOT NULL, title VARCHAR(254) NOT NULL, cid SMALLINT UNSIGNED DEFAULT 0 NOT NULL, type SMALLINT UNSIGNED DEFAULT 0 NOT NULL, mid MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT \'0\', excerpt VARCHAR(1000) NOT NULL, content TEXT NOT NULL, views MEDIUMINT(8) UNSIGNED NOT NULL DEFAULT \'0\', status TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\', mtime INT(10) UNSIGNED NOT NULL DEFAULT \'0\', ctime INT(10) UNSIGNED NOT NULL DEFAULT \'0\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mc_category (id INT AUTO_INCREMENT NOT NULL, parentid SMALLINT UNSIGNED DEFAULT 0 NOT NULL, name VARCHAR(254) NOT NULL, alias VARCHAR(254) NOT NULL, summary VARCHAR(254) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mc_links (id INT AUTO_INCREMENT NOT NULL, type SMALLINT UNSIGNED DEFAULT 0 NOT NULL, sid SMALLINT UNSIGNED DEFAULT 0 NOT NULL, name VARCHAR(254) NOT NULL, url VARCHAR(254) NOT NULL, notes VARCHAR(254) NOT NULL, img VARCHAR(254) NOT NULL, visible TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\', ctime INT(10) UNSIGNED NOT NULL DEFAULT \'0\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mc_member (id INT AUTO_INCREMENT NOT NULL, status TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\', level TINYINT(3) UNSIGNED NOT NULL DEFAULT \'0\', nickname VARCHAR(254) NOT NULL, mobile CHAR(11) NOT NULL, email VARCHAR(254) NOT NULL, password CHAR(32) NOT NULL, pwd VARCHAR(254) NOT NULL, url VARCHAR(254) NOT NULL, rtime INT(10) UNSIGNED NOT NULL DEFAULT \'0\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE mc_admin');
        $this->addSql('DROP TABLE mc_blog');
        $this->addSql('DROP TABLE mc_category');
        $this->addSql('DROP TABLE mc_links');
        $this->addSql('DROP TABLE mc_member');
    }
}
