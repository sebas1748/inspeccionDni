<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210408114756 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE delegaciones (id INT AUTO_INCREMENT NOT NULL, zona VARCHAR(2) DEFAULT NULL, partido VARCHAR(255) DEFAULT NULL, delegacion VARCHAR(255) DEFAULT NULL, campo4 VARCHAR(255) DEFAULT NULL, delegado VARCHAR(255) DEFAULT NULL, dep_id INT NOT NULL, cabecera VARCHAR(255) DEFAULT NULL, dias_atencion_moviles VARCHAR(255) DEFAULT NULL, telefono VARCHAR(255) DEFAULT NULL, domicilio VARCHAR(255) DEFAULT NULL, horario VARCHAR(255) DEFAULT NULL, nac DOUBLE PRECISION DEFAULT NULL, mat DOUBLE PRECISION NOT NULL, def VARCHAR(255) DEFAULT NULL, docs DOUBLE PRECISION DEFAULT NULL, partido_id VARCHAR(3) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lote (id INT AUTO_INCREMENT NOT NULL, delegaciones_id INT NOT NULL, codigo VARCHAR(255) NOT NULL, archivo VARCHAR(255) NOT NULL, INDEX IDX_65B4329F208FE9D1 (delegaciones_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lote ADD CONSTRAINT FK_65B4329F208FE9D1 FOREIGN KEY (delegaciones_id) REFERENCES delegaciones (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE lote DROP FOREIGN KEY FK_65B4329F208FE9D1');
        $this->addSql('DROP TABLE delegaciones');
        $this->addSql('DROP TABLE lote');
    }
}
