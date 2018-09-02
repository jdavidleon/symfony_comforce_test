<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180902152941 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
    	$places = [
    		'No defenir', 'Bogotá', 'México', 'Peru'
    	];


        foreach ($places as $place) {
        	$this->addSql('INSERT INTO places (places) VALUES ("'.$place.'")');
        }

    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
