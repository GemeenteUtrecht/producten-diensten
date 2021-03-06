<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use Symfony\Component\Validator\Constraints as Assert;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Groep
 * 
 * Beschrijving
 * 
 * @category   	Entity
 *
 * @author     	Ruben van der Linde <ruben@conduction.nl>
 * @license    	EUPL 1.2 https://opensource.org/licenses/EUPL-1.2 *
 * @version    	1.0
 *
 * @link   		http//:www.conduction.nl
 * @package		Commen Ground
 * @subpackage  Producten en Diensten
 * 
 *  @ApiResource( 
 *  collectionOperations={
 *  	"get"={
 *  		"normalizationContext"={"groups"={"read"}},
 *  		"denormalizationContext"={"groups"={"write"}},
 *      	"path"="/groepen",
 *  		"openapi_context" = {
 * 				"summary" = "Haalt een verzameling van Productgoepen op."
 *  		}
 *  	},
 *  	"post"={
 *  		"normalizationContext"={"groups"={"read"}},
 *  		"denormalizationContext"={"groups"={"write"}},
 *      	"path"="/groepen",
 *  		"openapi_context" = {
 * 					"summary" = "Maak een Productgroep aan."
 *  		}
 *  	}
 *  },
 * 	itemOperations={
 *     "get"={
 *  		"normalizationContext"={"groups"={"read"}},
 *  		"denormalizationContext"={"groups"={"write"}},
 *      	"path"="/groepen/{id}",
 *  		"openapi_context" = {
 * 				"summary" = "Haal een specifieke Productgroep op."
 *  		}
 *  	},
 *     "put"={
 *  		"normalizationContext"={"groups"={"read"}},
 *  		"denormalizationContext"={"groups"={"write"}},
 *      	"path"="/groepen/{id}",
 *  		"openapi_context" = {
 * 				"summary" = "Vervang een specifieke Productgroep."
 *  		}
 *  	},
 *     "delete"={
 *  		"normalizationContext"={"groups"={"read"}},
 *  		"denormalizationContext"={"groups"={"write"}},
 *      	"path"="/groepen/{id}",
 *  		"openapi_context" = {
 * 				"summary" = "Verwijder een specifieke Productgroep."
 *  		}
 *  	},
 *     "log"={
 *         	"method"="GET",
 *         	"path"="/groepen/{id}/log",
 *          "controller"= HuwelijkController::class,
 *     		"normalization_context"={"groups"={"read"}},
 *     		"denormalization_context"={"groups"={"write"}},
 *         	"openapi_context" = {
 *         		"summary" = "Logboek inzien",
 *         		"description" = "Geeft een array van eerdere versies en wijzigingen van dit object.",
 *          	"consumes" = {
 *              	"application/json",
 *               	"text/html",
 *            	},
 *             	"produces" = {
 *         			"application/json"
 *            	}
 *         }
 *     },
 *     "revert"={
 *         	"method"="POST",
 *         	"path"="/groepen/{id}/revert/{version}",
 *          "controller"= HuwelijkController::class,
 *     		"normalization_context"={"groups"={"read"}},
 *     		"denormalization_context"={"groups"={"write"}},
 *         	"openapi_context" = {
 *         		"summary" = "Versie herstellen",
 *         		"description" = "Herstel een eerdere versie van dit object. Dit is een destructieve actie die niet ongedaan kan worden gemaakt.",
 *          	"consumes" = {
 *              	"application/json",
 *               	"text/html",
 *            	},
 *             	"produces" = {
 *         			"application/json"
 *            	}
 *         }
 *     }
 *  }
 * )
 * @ORM\Entity
 * @Gedmo\Loggable(logEntryClass="ActivityLogBundle\Entity\LogEntry")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(
 *     fields={"identificatie", "bronOrganisatie"},
 *     message="De identificatie dient uniek te zijn voor de bronOrganisatie."
 * )
 */

class Groep
{
	
	/**
	 * Het identificatie nummer van deze Productgroep. <br /><b>Schema:</b> <a href="https://schema.org/identifier">https://schema.org/identifier</a>
	 *
	 * @var int|null
	 *
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer", options={"unsigned": true})
	 * @Groups({"read", "write"})
	 * @ApiProperty(iri="https://schema.org/identifier")
	 **/
	public $id;
	
	/**
	 * URL-referentie naar het afbeeldingsdocument van deze Productgroep.
	 *
	 * @ORM\Column(
	 *     type     = "string",
	 *     nullable = true
	 * )
	 * @Groups({"read", "write"})
	 * @ApiProperty(
	 *     attributes={
	 *         "openapi_context"={
	 *             "title"="BRP",
	 *             "type"="url",
	 *             "example"="https://ref.tst.vng.cloud/zrc/api/v1/zaken/24524f1c-1c14-4801-9535-22007b8d1b65",
	 *             "required"="true",
	 *             "maxLength"=255,
	 *             "format"="uri",
	 *             "description"="URL-referentie naar het afbeeldingsdocument van deze Productgroep."
	 *         }
	 *     }
	 * )
	 * @Gedmo\Versioned
	 */
	public $afbeelding;
	
	/**
	 * URL-referentie naar het film document van deze Productgroep.
	 *
	 * @ORM\Column(
	 *     type     = "string",
	 *     nullable = true
	 * )
	 * @Groups({"read", "write"})
	 * @ApiProperty(
	 *     attributes={
	 *         "openapi_context"={
	 *             "title"="BRP",
	 *             "type"="url",
	 *             "example"="https://ref.tst.vng.cloud/zrc/api/v1/zaken/24524f1c-1c14-4801-9535-22007b8d1b65",
	 *             "required"="true",
	 *             "maxLength"=255,
	 *             "format"="uri",
	 *             "description"="URL-referentie naar het film document van deze Productgroep."
	 *         }
	 *     }
	 * )
	 * @Gedmo\Versioned
	 */
	public $film;
	
	
	/**
	 * De unieke identificatie van de productgroep binnen de organisatie.
	 *
	 * @var string
	 * @ORM\Column(
	 *     type     = "string"
	 * )
	 * @Groups({"read", "write"})
	 * @ApiProperty(
	 *     attributes={
	 *         "openapi_context"={
	 *             "type"="string",
	 *             "example"="6a36c2c4-213e-4348-a467-dfa3a30f64aa",
	 *             "description"="De unieke identificatie van de productgroep binnen de organisatie.",
	 *             "required"="true",
	 *             "maxLength"=40
	 *         }
	 *     }
	 * )
	 */
	public $identificatie;
	
	/**
	 * Het RSIN van de organisatie waartoe deze Productgroep behoort. Dit moet een geldig RSIN zijn van 9 nummers en voldoen aan https://nl.wikipedia.org/wiki/Burgerservicenummer#11-proef. <br> Het RSIN word bepaald aan de hand van de geauthenticeerde applicatie en kan niet worden overschreven.
	 *
	 * @var integer
	 * @ORM\Column(
	 *     type     = "integer",
	 *     length   = 9
	 * )
	 * @Assert\Length(
	 *      min = 8,
	 *      max = 9,
	 *      minMessage = "Het RSIN moet ten minste {{ limit }} karakters lang zijn.",
	 *      maxMessage = "Het RSIN kan niet langer dan {{ limit }} karakters zijn."
	 * )
	 * @Groups({"read"})
	 * @ApiFilter(SearchFilter::class, strategy="exact")
	 * @ApiFilter(OrderFilter::class)
	 * @ApiProperty(
	 *     attributes={
	 *         "openapi_context"={
	 *             "title"="bronOrganisatie",
	 *             "type"="string",
	 *             "example"="123456789",
	 *             "required"="true",
	 *             "maxLength"=9,
	 *             "minLength"=8
	 *         }
	 *     }
	 * )
	 */
	public $bronOrganisatie;
	
	/**
	 * De naam van deze Productgroep. <br /><b>Schema:</b> <a href="https://schema.org/name">https://schema.org/name</a>
	 *
	 * @var string
	 *
	 * @ORM\Column(
	 *     type     = "string",
	 *     length   = 255
	 * )
	 * @Assert\NotNull
	 * @Assert\Length(
	 *      min = 5,
	 *      max = 255,
	 *      minMessage = "De naam moet ten minste {{ limit }} karakters lang zijn.",
	 *      maxMessage = "De naam kan niet langer dan {{ limit }} karakters zijn."
	 * )
	 * @Groups({"read", "write"})
	 * @ApiProperty(
	 * 	   iri="http://schema.org/name",	 
     *     attributes={
     *         "swagger_context"={
     *             "type"="string",
     *             "example"="Glazen"
     *         }
     *     }
	 * )
	 **/
	public $naam;
	
	/**
	 * Een korte samenvattende tekst over deze Productgroep bedoeld ter introductie.  <br /><b>Schema:</b> <a href="https://schema.org/description">https://schema.org/description</a>
	 *
	 * @var string
	 *
	 * @ORM\Column(
	 *     type     = "text"
	 * )
	 * @Assert\NotNull
	 * @Assert\Length(
	 *      min = 25,
	 *      max = 2000,
	 *      minMessage = "De productgroep samenvatting moet minstens {{ limit }} karakters lang zijn.",
	 *      maxMessage = "De productgroep samenvatting kan maximaal {{ limit }}  karakters lang zijn.")
	 *
	 * @Groups({"read", "write"})
	 * @ApiProperty(
	 * 	  iri="https://schema.org/description",
	 *     attributes={
	 *         "swagger_context"={
	 *             "type"="string",
	 *             "example"="Bekijk onze prachtige collectie glazen"
	 *         }
	 *     }
	 * )
	 **/
	public $samenvatting;
	
	/** 
	 * Een uitgebreide beschrijvende tekst over deze Productgroep bedoeld ter verdere verduidelijking.  <br /><b>Schema:</b> <a href="https://schema.org/description">https://schema.org/description</a>
	 *
	 * @var string
	 *
	 * @ORM\Column(
	 *     type     = "text"
	 * )
	 * @Assert\NotNull
	 * @Assert\Length(
	 *      min = 25,
	 *      max = 2000,
	 *      minMessage = "De productgroep beschrijving moet minstens {{ limit }} karakters lang zijn.",
	 *      maxMessage = "De productgroep beschrijving kan maximaal {{ limit }} karakters lang zijn.")
	 *
	  * @ApiProperty(
	 * 	  iri="https://schema.org/description",	 
     *     attributes={
     *         "swagger_context"={
     *             "type"="string",
     *             "example"="Binnen onze collectie glazen vind u alle types die u zich maar kan wensne. Deze glazen zijn zeker het aanbevelen waard"
     *         }
     *     }
	 * )
	 **/
	public $beschrijving;
	
	/**
	 * De taal waarin de informatie van deze Productgroep is opgesteld. <br /><b>Schema:</b> <a href="https://www.ietf.org/rfc/rfc3066.txt">https://www.ietf.org/rfc/rfc3066.txt</a>
	 *
	 * @var string Een Unicode language identifier, ofwel RFC 3066 taalcode.
	 *
	 * @ORM\Column(
	 *     type     = "string",
	 *     length   = 2
	 * )
	 * @Assert\Language
	 * @Groups({"read", "write"})
	 * @ApiProperty(
	 *     attributes={
	 *         "swagger_context"={
	 *             "type"="string",
	 *             "example"="NL"
	 *         }
	 *     }
	 * )
	 **/
	public $taal = "nl";
	
	/**
	 * De producten de bij deze Productgroep horen.
	 *
	 * @var \Doctrine\Common\Collections\Collection|\App\Entity\Product[]
	 *
	 * @ORM\ManyToMany(targetEntity="\App\Entity\Product", mappedBy="groepen")
	 * @Groups({"read"})
	 *
	 */
	public $producten;
	
	/**
	 * Voeg Product toe.
	 *
	 * @param  \App\Entity\Product $product
	 * @return Order
	 */
	public function addProduct(\App\Entity\Product $product)
	{
		$this->products[] = $product;
		
		return $this;
	}
	
	/**
	 * Verwijder Product.
	 *
	 * @param \App\Entity\Product $product
	 */
	public function removeProduct(\App\Entity\Product $product)
	{
		$this->products->removeElement($product);
	}
	
	/**
	 * Haal Product op.
	 *
	 * @return \Doctrine\Common\Collections\Collection
	 */
	public function getProducts()
	{
		return $this->products;
	}

	public function getUrl()
	{
		return 'http://producten_en_diensten.demo.zaakonline.nl/groepen/'.$this->id;
	}
}
