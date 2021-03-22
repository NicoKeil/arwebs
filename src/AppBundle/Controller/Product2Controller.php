<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use Symfony\Component\HttpFoundation\File\UploadedFile;
/**
 * Product2 controller.
 *
 */
class Product2Controller extends Controller
{
    /**
     * Lists all product2 entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $use_repo = $em->getRepository('AppBundle:Category')->findAll();
        $product2s = $em->getRepository('AppBundle:Product2')->findAll();
            
     
       
        return $this->render('product2/index.html.twig', array(
            'product2s' => $product2s,
        ));
    }

    /**
     * Creates a new product2 entity.
     *
     */
    public function newAction(Request $request)
    {
        $product2 = new Product2();
        $form = $this->createForm('AppBundle\Form\Product2Type', $product2);
        
        
        $form->handleRequest($request);
        var_dump($product2);
        die();
        if(!$form['image']){
            // Recogemos el fichero
        $file = $form['image']->getData();
            
        // Sacamos la extensión del fichero
    
        $ext = $file->guessExtension();
            die($ext);
        // Le ponemos un nombre al fichero
        $file_name=time().".".$ext;
        
        // Guardamos el fichero en el directorio uploads que estará en el directorio /web del framework
        $file->move("uploads", $file_name);
        
        // Establecemos el nombre de fichero en el atributo de la entidad
        $product2->setImage($file_name);
            }
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product2);
            $em->flush();

            return $this->redirectToRoute('product2_show', array('id' => $product2->getId()));
        }

        return $this->render('product2/new.html.twig', array(
            'product2' => $product2,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product2 entity.
     *
     */
    public function showAction(Product2 $product2)
    {
        $deleteForm = $this->createDeleteForm($product2);

        return $this->render('product2/show.html.twig', array(
            'product2' => $product2,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product2 entity.
     *
     */
    public function editAction(Request $request, Product2 $product2)
    {
        $deleteForm = $this->createDeleteForm($product2);
        $editForm = $this->createForm('AppBundle\Form\Product2Type', $product2);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product2_edit', array('id' => $product2->getId()));
        }

        return $this->render('product2/edit.html.twig', array(
            'product2' => $product2,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a product2 entity.
     *
     */
    public function deleteAction(Request $request, Product2 $product2)
    {
        $form = $this->createDeleteForm($product2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product2);
            $em->flush();
        }

        return $this->redirectToRoute('product2_index');
    }

    /**
     * Creates a form to delete a product2 entity.
     *
     * @param Product2 $product2 The product2 entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product2 $product2)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product2_delete', array('id' => $product2->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
