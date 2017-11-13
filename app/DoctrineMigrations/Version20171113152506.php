<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20171113152506 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE b2bmarketingrequest CHANGE contact_number contact_number VARCHAR(35) NOT NULL COMMENT \'(DC2Type:phone_number)\'');
        $this->addSql('ALTER TABLE marketingsalesrequest CHANGE contact_number contact_number VARCHAR(35) NOT NULL COMMENT \'(DC2Type:phone_number)\'');
        $this->addSql('ALTER TABLE packagedesignrequest CHANGE contact_number contact_number VARCHAR(35) NOT NULL COMMENT \'(DC2Type:phone_number)\'');
        $this->addSql('ALTER TABLE photorequest CHANGE contact_number contact_number VARCHAR(35) NOT NULL COMMENT \'(DC2Type:phone_number)\'');
        $this->addSql('ALTER TABLE productdesignrequest CHANGE contact_number contact_number VARCHAR(35) NOT NULL COMMENT \'(DC2Type:phone_number)\'');
        $this->addSql('ALTER TABLE videorequest CHANGE contact_number contact_number VARCHAR(35) NOT NULL COMMENT \'(DC2Type:phone_number)\'');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE B2BMarketingRequest CHANGE contact_number contact_number VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE MarketingSalesRequest CHANGE contact_number contact_number VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE PackageDesignRequest CHANGE contact_number contact_number VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE PhotoRequest CHANGE contact_number contact_number VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE ProductDesignRequest CHANGE contact_number contact_number VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE VideoRequest CHANGE contact_number contact_number VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
    }
}
