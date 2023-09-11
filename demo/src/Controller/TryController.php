<?php
namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\UserType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;


class TryController extends AbstractController
{
    #[Route('/')]

    public function homepage(Request $request, PersistenceManagerRegistry $doctrine): Response
    {

        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);
        // $this->saveUserDataToDatabase($form->getData());
            // die;
        if ($form->isSubmitted() && $form->isValid()) {
            // Process the form data here
            $formData = $form->getData();

            // Save the user data to the database (e.g., using Doctrine DBAL)
            $this->saveUserDataToDatabase($formData);

        }

        return $this->render('home/home.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    private function saveUserDataToDatabase(array $userData)
    {
    
        $connection = $this->$doctrine->getConnection();
        // var_dump($connection);
        // die;

        $tableName = 'users';

        // Insert the user data into the database
        $connection->insert($tableName, $userData);
        
        $userId = $connection->lastInsertId();

    }
}
?>  