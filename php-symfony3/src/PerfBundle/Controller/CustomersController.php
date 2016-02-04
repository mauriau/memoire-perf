<?php

namespace PerfBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PerfBundle\Entity\Customers;
use PerfBundle\Form\CustomersType;

/**
 * Customers controller.
 *
 * @Route("/customers")
 */
class CustomersController extends Controller
{
    /**
     * Lists all Customers entities.
     *
     * @Route("/", name="customers_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $customers = $em->getRepository('PerfBundle:Customers')->findAll();

        return $this->render('customers/index.html.twig', array(
            'customers' => $customers,
        ));
    }

    /**
     * Creates a new Customers entity.
     *
     * @Route("/new", name="customers_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $customer = new Customers();
        $form = $this->createForm('PerfBundle\Form\CustomersType', $customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            return $this->redirectToRoute('customers_show', array('id' => $customers->getId()));
        }

        return $this->render('customers/new.html.twig', array(
            'customer' => $customer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Customers entity.
     *
     * @Route("/{id}", name="customers_show")
     * @Method("GET")
     */
    public function showAction(Customers $customer)
    {
        $deleteForm = $this->createDeleteForm($customer);

        return $this->render('customers/show.html.twig', array(
            'customer' => $customer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Customers entity.
     *
     * @Route("/{id}/edit", name="customers_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Customers $customer)
    {
        $deleteForm = $this->createDeleteForm($customer);
        $editForm = $this->createForm('PerfBundle\Form\CustomersType', $customer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($customer);
            $em->flush();

            return $this->redirectToRoute('customers_edit', array('id' => $customer->getId()));
        }

        return $this->render('customers/edit.html.twig', array(
            'customer' => $customer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Customers entity.
     *
     * @Route("/{id}", name="customers_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Customers $customer)
    {
        $form = $this->createDeleteForm($customer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($customer);
            $em->flush();
        }

        return $this->redirectToRoute('customers_index');
    }

    /**
     * Creates a form to delete a Customers entity.
     *
     * @param Customers $customer The Customers entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Customers $customer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('customers_delete', array('id' => $customer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
