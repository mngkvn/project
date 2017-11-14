<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171114171032 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE photorequest CHANGE type category VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE b2bmarketingrequest CHANGE type category VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE marketingsalesrequest CHANGE type category VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE packagedesignrequest CHANGE type category VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE productdesignrequest CHANGE type category VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE videorequest CHANGE type category VARCHAR(255) NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE B2BMarketingRequest CHANGE category type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE MarketingSalesRequest CHANGE category type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE PackageDesignRequest CHANGE category type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE PhotoRequest CHANGE category type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE ProductDesignRequest CHANGE category type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE VideoRequest CHANGE category type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}