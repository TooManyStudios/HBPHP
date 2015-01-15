<?php

namespace HB\Bundle\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use HB\Bundle\BlogBundle\Entity\Article;
use HB\Bundle\BlogBundle\Form\ArticleType;
use HB\Bundle\BlogBundle\Entity\Commentaire;
use HB\Bundle\BlogBundle\Form\CommentaireType;

/**
 * Article Controller
 * 
 * @Route("/article")
 */
class ArticleController extends Controller
{
    /**
     * List articles
     * 
     * @Route("/", name="article_list")
     * @Template("HBBlogBundle:Article:list.html.twig")
     */
    public function indexAction()
    {
    	$articles = $this->getDoctrine()
    	->getRepository("HBBlogBundle:Article")
    	->findAll();
    	 
    	return array("articles" => $articles);
    }
    
    /**
     * Add article
     *
     * @Route("/add", name="article_add")
     * @Template("HBBlogBundle:Article:edit.html.twig")
     */
    public function addAction()
    {
    	$article = new Article();
    	// on force l'auteur sur l'utilisateur enregistré
    	$article->setAuteur($this->getUser());
    	return $this->addEditForm($article);
    }
    
    /**
     * Edit article
     *
     * @Route("/edit/{id}", name="article_edit")
     * @Template()
     */
    public function editAction(Article $article)
    {
    	return $this->addEditForm($article);
    }
    
    private function addEditForm($article) {
    	/*
    	// On crée le FormBuilder grâce à la méthode du contrôleur
    	// et on lui passe notre $article (hydraté ou non)
    	$formBuilder = $this->createFormBuilder($article);
    	 
    	// On ajoute les champs de l'entité que l'on veut à notre formulaire
    	$type = new ArticleType;
    	$type->buildForm($formBuilder, array());
    	 
    	// À partir du formBuilder, on génère le formulaire
    	$form = $formBuilder->getForm();
    	*/
    	$form = $this->createForm(new ArticleType(), $article);
    	 
    	// On récupère la requête
    	$request = $this->get('request');
    	 
    	// On vérifie qu'elle est de type POST pour voir si un formulaire a été soumis
    	if ($request->getMethod() == 'POST') {
    		// On fait le lien Requête <-> Formulaire
    		// À partir de maintenant, la variable $article contient les valeurs entrées dans
    		// le formulaire par le visiteur
    		$form->bind($request);
    		// On vérifie que les valeurs entrées sont correctes
    		// (Nous verrons la validation des objets en détail dans le prochain chapitre)
    		if ($form->isValid()) {
    			// On enregistre notre objet $article dans la base de données
    			$em = $this->getDoctrine()->getManager();
    			$em->persist($article);
    			$em->flush();
    			 
    			// On redirige vers la page de visualisation de l'article nouvellement créé
    			return $this->redirect($this->generateUrl('article_list', array('id' => $article->getId())));
    		}
    	}
    	 
    	// On passe la méthode createView() du formulaire à la vue afin qu'elle puisse afficher
    	// le formulaire toute seule, on a d'autres méthodes si on veut personnaliser
    	return array( 'form' => $form->createView() );
    }
    
    /**
     * Read/view article
     *
     * @Route("/read/{id}", name="article_read")
     * @Template("HBBlogBundle:Article:read.html.twig")
     */
    public function readAction(Article $article)
    {
    	// Si on a une requête POST, c'est qu'un commentaire a été soumis
		$request = $this->get('request');
		if ($request->getMethod() == 'POST') {

			$commentaire = new Commentaire();
			$commentaire->setArticle($article);
			$commentaire->setAuteur($this->getUser());
			$form = $this->createForm(new CommentaireType(), $commentaire);
			$form->bind($request);
			
			if ($form->isValid()) {
				// On enregistre notre objet $commentaire dans la base de données
				$em = $this->getDoctrine()->getManager();
				$em->persist($commentaire);
				$em->flush();
		
				// On redirige vers la page de visualisation de l'article nouvellement créé
				return $this->redirect($this->generateUrl('article_read', array('id' => $article->getId())));
			}
		}
		
		return array("article" => $article);
    }
    
    
    /**
     * Delete article
     * 
     * @Route("/delete/{id}", name="article_delete")
     * @Template()
     */
    public function deleteAction(Article $article)
    {
		$em = $this->getDoctrine()->getEntityManager();
		$em->remove($article);
		$em->flush();
		return $this->redirect($this->generateUrl('article_list'));
	}
    
    
}