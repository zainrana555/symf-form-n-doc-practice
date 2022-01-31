<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use App\Form\Type\TaskType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Service\MessageGenerator;

class TaskController extends AbstractController
{
    /**
     * @Route("/task", name="task")
     */
    public function new(Request $request,ValidatorInterface $validator): Response
    {
        // just set up a fresh $task object (remove the example data)
        $task = new Task();

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $task = $form->getData();

            $errors = $validator->validate($task);

            if (count($errors) > 0) {
                /*
                 * Uses a __toString method on the $errors variable which is a
                 * ConstraintViolationList object. This gives us a nice string
                 * for debugging.
                 */
                $errorsString = (string) $errors;

                return new Response($errorsString);
            }else{
                dd($task);
            }

            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('task_success');
        }

        return $this->renderForm('task/new.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/task-success", name="task_success")
     */
    public function success(Request $request): Response
    {
        dd("Success");    
    }

    /**
     * @Route("/message")
     */
    public function message(MessageGenerator $messageGenerator): Response
    {
        // thanks to the type-hint, the container will instantiate a
        // new MessageGenerator and pass it to you!
        // ...

        $message = $messageGenerator->getHappyMessage();
        dd($message);
        // ...
    }
        
}
