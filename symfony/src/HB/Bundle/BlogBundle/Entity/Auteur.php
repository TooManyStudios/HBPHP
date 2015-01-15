<?php

namespace HB\Bundle\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use JMS\Serializer\Annotation\MaxDepth;

/**
 * Auteur
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="HB\Bundle\BlogBundle\Entity\AuteurRepository")
 */
class Auteur implements UserInterface
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="pseudo", type="string", length=255)
     */
    private $pseudo;
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
    
    /**
     * 
     * @var Collection
     * 
     * @ORM\OneToMany(targetEntity="Article", mappedBy="auteur", cascade="remove")
     * @MaxDepth(2)
     */
    private $articles;

    /**
     *
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="Commentaire", mappedBy="auteur", cascade="remove")
     * @MaxDepth(3)
     */
    private $commentaires;

    /**
     * Constructor
     */
    public function __construct()
    {
    	$this->articles = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     * @return Auteur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return Auteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set pseudo
     *
     * @param string $pseudo
     * @return Auteur
     */
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;

        return $this;
    }

    /**
     * Get pseudo
     *
     * @return string 
     */
    public function getPseudo()
    {
        return $this->pseudo;
    }
    
    /**
     * Set password
     * 
     * @param string $password
     * @return Auteur
     */
    public function setPassword($password) {
    	$this->password = $password;
    	 
    	return $this;
    }

    /**
     * Add article
     *
     * @param Article $article
     * @return Auteur
     */
    public function addArticle(Article $article)
    {
    	$article->setAuteur($this);
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param Article $article
     */
    public function removeArticle(Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Add commentaire
     *
     * @param Commentaire $commentaire
     * @return Auteur
     */
    public function addCommentaire(Commentaire $commentaire)
    {
    	$commentaire->setAuteur($this);
        $this->commentaires[] = $commentaire;

        return $this;
    }

    /**
     * Remove commentaire
     *
     * @param Commentaire $commentaire
     */
    public function removeCommentaire(Commentaire $commentaire)
    {
        $this->commentaires->removeElement($commentaire);
    }

    /**
     * Get commentaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }
    
    // méthodes de l'interface UserInterface
    public function eraseCredentials() {
    
    }
    
    public function getPassword() {
    	return $this->password;
    }
    
    public function getRoles() {
    	return array('ROLE_USER');
    }
    
    public function getSalt() {
    	return null;
    }
    
    public function getUsername() {
    	return $this->pseudo;
    }
    
}
