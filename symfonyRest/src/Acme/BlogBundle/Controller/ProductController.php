<?php

namespace Acme\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\BlogBundle\Document\Product;
use Symfony\Component\HttpFoundation\Response;

/**
 * Product Controller
 *
 * @Route("/product")
 */
class ProductController extends Controller
{
	/**
	 * @Route("/create/", name="product_create")
	 * @Template()
	 */
	public function createAction() {
		$product = new Product();
		$product->setName('Produit A');
		$product->setPrice('19.99');
		
		$dm = $this->get('doctrine_mongodb')->getManager();
		$dm->persist($product);
		$dm->flush();
		
		return new Response('Created product id '.$product->getId().'<br><a href="../show/">Back to list</a>');
	}
	
	/**
	 * @Route("/show/{id}", name="product_show")
	 * @Template("AcmeBlogBundle:Product:showProduct.html.twig")
	 */
	public function showAction($id)
	{
		$product = $this->get('doctrine_mongodb')
	        ->getRepository('AcmeBlogBundle:Product')
	        ->find($id);
	
	    if (!$product) {
	        throw $this->createNotFoundException('No product found for id '.$id);
	    }
	    
	    return array("product" => $product);
	}
	
	/**
	 * @Route("/show/", name="product_show_all")
	 * @Template("AcmeBlogBundle:Product:showProducts.html.twig")
	 */
	public function showAllAction()
	{
		$products = $this->get('doctrine_mongodb')
		->getRepository('AcmeBlogBundle:Product')
		->findAll();
		 
		return array("products" => $products);
	}
	
}
