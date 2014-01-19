<?php

namespace Poodle\TestBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Poodle\TestBundle\Entity\Exam;
use Poodle\TestBundle\Entity\Question;
use Poodle\TestBundle\Form\ExamType;


/**
 * Exam controller.
 *
 * @Route("/exam")
 */
class ExamController extends Controller {

    /**
     * Lists all Exam entities.
     *
     * 
     * @Method("GET")
     *  @Template("TestBundle:Exam:index.html.twig")
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('TestBundle:Exam')->findAll();

        return $this->render(
                        'TestBundle:Exam:index.html.twig', array('entities' => $entities)
        );
    }

    /**
     * Creates a new Exam entity.
     *
     * 
     * @Method("POST")
     * @Template("TestBundle:Exam:new.html.twig")
     */
    public function createAction(Request $request) {
        $entity = new Exam();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            return $this->redirect($this->generateUrl('test_exam_show', array('id' => $entity->getId())));
        }
        
        return array(
            'entity' => $entity,
            'form' => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Exam entity.
     *
     * @param Exam $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Exam $entity) {
        $form = $this->createForm(new ExamType(), $entity, array(
            'action' => $this->generateUrl('test_exam_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Exam entity.
     *
     * 
     * @Method("GET")
     *
     */
    public function newAction() {
        $entity = new Exam();
        $form = $this->createCreateForm($entity);

        return $this->render(
                        'TestBundle:Exam:new.html.twig', array(
                    'entity' => $entity,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Exam entity.
     *
     * 
     * @Method("GET")
     * @Template()
     */
    public function showAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestBundle:Exam')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exam entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity' => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Exam entity.
     *
     * 
     * @Method("GET")
     * @Template()
     */
    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestBundle:Exam')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exam entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);


        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to edit a Exam entity.
     *
     * @param Exam $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createEditForm(Exam $entity) {
        $form = $this->createForm(new ExamType(), $entity, array(
            'action' => $this->generateUrl('test_exam_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    /**
     * Edits an existing Exam entity.
     *
     * 
     * @Method("PUT")
     * @Template("TestBundle:Exam:edit.html.twig")
     */
    public function updateAction(Request $request, $id) {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('TestBundle:Exam')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Exam entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('exam_edit', array('id' => $id)));
        }

        return array(
            'entity' => $entity,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Deletes a Exam entity.
     *
     *
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id) {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('TestBundle:Exam')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Exam entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('exam'));
    }

    /**
     * Creates a form to delete a Exam entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('test_exam_delete', array('id' => $id)))
                        ->setMethod('DELETE')
                        ->add('submit', 'submit', array('label' => 'Delete'))
                        ->getForm()
        ;
    }
    
    
    
    
    
    
    /**
     * 
     * 
     * 
     * 
     * Pytania
     * 
     * 
     * 
     * 
     */
    
    public function addQuestionAction(Request $request, $examId)
    {
        $em = $this->getDoctrine()->getManager();

        $exam = $em->getRepository('TestBundle:Exam')->find($examId);

        if (!$exam) {
            throw $this->createNotFoundException('Unable to find Exam entity.');
        }
        $question  = new Question();
        $question->setExam($exam);
        $form = $this-> createFormBuilder($question, array(
            'action' => $this->generateUrl('test_exam_add_question', array('examId' => $exam->getId())),
            'method' => 'PUT',
        )) 
                ->getForm();
        
       
        $form->add('body', 'text', array('label' => 'Pytanie'));
        
        $form->add('qType', 'choice', array(
            'choices'   => array(
                    'OPEN'   => 'odpowiedź otwarta',
                    'ONE' => 'Jednokrotnego wyboru',
                    'MULTIPLY'   => 'Wielokrotnego wyboru',
                ),
                'multiple'  => false,
                'required' => true,
                'preferred_choices' => array('OPEN')
        ));

        $form->add('answers', 'collection', array(
            'type'   => 'test',
            'options'  => array(
                'required'  => false
            ),
        ));
        
        $form->add('submit', 'submit', array('label' => 'Dodaj'));
        

        $form->handleRequest($request);
        
        if($form->isValid())
        {
           $em = $this->getDoctrine()->getManager();
            $em->persist($question);
            $em->flush(); 
            
            return $this->redirect($this->generateUrl('test_exam_edit', array('id' => $examId)));
        }

        
        return $this->render(
                'TestBundle:Exam:addQuestion.html.twig', array(
                'entity' => $exam,
                'form' => $form->createView()
        ));
        
    }
    
    
    
    /**
     * 
     * 
     * 
     * Odpowiedzi
     * 
     * 
     * 
     */
    public function addAnswerToQuestionAction(Request $request, $questionId)
    {
        
    }

}
