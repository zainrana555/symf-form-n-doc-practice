<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Author;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author", name="author")
     */
    public function index(ValidatorInterface $validator): Response
    {
        $author = new Author();
        $author->setName("Hehe");

        // ... do something to the $author object

        $errors = $validator->validate($author);

        if (count($errors) > 0) {
            // return $this->render('author/index.html.twig', [
            //     'errors' => $errors,
            // ]);
            /*
             * Uses a __toString method on the $errors variable which is a
             * ConstraintViolationList object. This gives us a nice string
             * for debugging.
             */
            $errorsString = (string) $errors;

            return new Response($errorsString);
        }

        return new Response('The author is valid! Yes!');
    }
}
