<?php

namespace PerfBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PerfBundle\Entity\Productlines;
use PerfBundle\Form\ProductlinesType;

/**
 * Productlines controller.
 *
 * @Route("/productlines")
 */
class ProductlinesController extends Controller
{
    /**
     * Lists all Productlines entities.
     *
     * @Route("/", name="productlines_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $productlines = $em->getRepository('PerfBundle:Productlines')->findAll();

        return $this->render('productlines/index.html.twig', array(
            'productlines' => $productlines,
        ));
    }

    /**
     * Creates a new Productlines entity.
     *
     * @Route("/new", name="productlines_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $productline = new Productlines();
        $form = $this->createForm('PerfBundle\Form\ProductlinesType', $productline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productline);
            $em->flush();

            return $this->redirectToRoute('productlines_show', array('id' => $productlines->getId()));
        }

        return $this->render('productlines/new.html.twig', array(
            'productline' => $productline,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Productlines entity.
     *
     * @Route("/{id}", name="productlines_show")
     * @Method("GET")
     */
    public function showAction(Productlines $productline)
    {
        $deleteForm = $this->createDeleteForm($productline);

        return $this->render('productlines/show.html.twig', array(
            'productline' => $productline,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Productlines entity.
     *
     * @Route("/{id}/edit", name="productlines_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Productlines $productline)
    {
        $deleteForm = $this->createDeleteForm($productline);
        $editForm = $this->createForm('PerfBundle\Form\ProductlinesType', $productline);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($productline);
            $em->flush();

            return $this->redirectToRoute('productlines_edit', array('id' => $productline->getId()));
        }

        return $this->render('productlines/edit.html.twig', array(
            'productline' => $productline,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Productlines entity.
     *
     * @Route("/{id}", name="productlines_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Productlines $productline)
    {
        $form = $this->createDeleteForm($productline);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($productline);
            $em->flush();
        }

        return $this->redirectToRoute('productlines_index');
    }

    /**
     * Creates a form to delete a Productlines entity.
     *
     * @param Productlines $productline The Productlines entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Productlines $productline)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('productlines_delete', array('id' => $productline->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
