<?php

namespace PerfBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PerfBundle\Entity\Employees;
use PerfBundle\Form\EmployeesType;

/**
 * Employees controller.
 *
 * @Route("/employees")
 */
class EmployeesController extends Controller
{
    /**
     * Lists all Employees entities.
     *
     * @Route("/", name="employees_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $employees = $em->getRepository('PerfBundle:Employees')->findAll();

        return $this->render('employees/index.html.twig', array(
            'employees' => $employees,
        ));
    }

    /**
     * Creates a new Employees entity.
     *
     * @Route("/new", name="employees_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $employee = new Employees();
        $form = $this->createForm('PerfBundle\Form\EmployeesType', $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            return $this->redirectToRoute('employees_show', array('id' => $employees->getId()));
        }

        return $this->render('employees/new.html.twig', array(
            'employee' => $employee,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Employees entity.
     *
     * @Route("/{id}", name="employees_show")
     * @Method("GET")
     */
    public function showAction(Employees $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);

        return $this->render('employees/show.html.twig', array(
            'employee' => $employee,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Employees entity.
     *
     * @Route("/{id}/edit", name="employees_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Employees $employee)
    {
        $deleteForm = $this->createDeleteForm($employee);
        $editForm = $this->createForm('PerfBundle\Form\EmployeesType', $employee);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($employee);
            $em->flush();

            return $this->redirectToRoute('employees_edit', array('id' => $employee->getId()));
        }

        return $this->render('employees/edit.html.twig', array(
            'employee' => $employee,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Employees entity.
     *
     * @Route("/{id}", name="employees_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Employees $employee)
    {
        $form = $this->createDeleteForm($employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($employee);
            $em->flush();
        }

        return $this->redirectToRoute('employees_index');
    }

    /**
     * Creates a form to delete a Employees entity.
     *
     * @param Employees $employee The Employees entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Employees $employee)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('employees_delete', array('id' => $employee->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
