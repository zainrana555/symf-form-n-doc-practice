<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LuckController extends AbstractController
{
    /**
    * @Route("/lucky/number/{num<\d+>?}", 
    *        name="app_lucky_number",
    *        methods={"GET"},
    * )
    */
    public function number(?int $num): Response
    {
        $number = random_int(0, 100);

        return $this->render('number.html.twig', [
            'number' => $num,
        ]);
    }

    /**
     * This route has a greedy pattern and is defined first.
     *
     * @Route("/blog/{slug}", name="blog_show")
     */
    public function show(string $slug)
    {
        dd("hehe");
    }

    /**
     * This route could not be matched without defining a higher priority than 0.
     *
     * @Route("/blog/list", name="blog_list", priority=1)
     */
    public function list()
    {
        dd("haha");
    }

     /**
     * @Route("/user/notifications", name="notifications")
     */
    public function notifications(): Response
    {
        $projectDir = $this->getParameter('kernel.project_dir');
        dd($projectDir);

        // get the user information and notifications somehow
        $userFirstName = 'Zee';
        $userNotifications = ['Please login your account', 'Update your profile'];

        // the template path is the relative file path from `templates/`
        return $this->render('user/notifications.html.twig', [
            // this array defines the variables passed to the template,
            // where the key is the variable name and the value is the variable value
            // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
            'user_first_name' => $userFirstName,
            'notifications' => $userNotifications,
        ]);
    }

    /**
     * @Route("/user/notifications_frag", name="notifications_frag")
     */
    public function notificationsFrag(Request $request): Response
    {
        // the template path is the relative file path from `templates/`
        return $this->render('user/_notifications_frag.html.twig', [
            // this array defines the variables passed to the template,
            // where the key is the variable name and the value is the variable value
            // (Twig recommends using snake_case variable names: 'foo_bar' instead of 'fooBar')
            'notifications' => $request->query->get('userNotifications'),
        ]);
    }
}