// src/Controller/TicketController.php
namespace App\Controller;

use App\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\Validator\Constraints\File;

class TicketController extends AbstractController
{
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        // Crée un nouveau ticket
        $ticket = new Ticket();
        
        // Crée le formulaire
        $form = $this->createFormBuilder($ticket)
            ->add('title', TextType::class, [
                'label' => 'Titre du ticket',
                'attr' => ['placeholder' => 'Entrez un titre clair']
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description détaillée',
                'attr' => ['rows' => 5]
            ])
            ->add('attachment', FileType::class, [
                'label' => 'Pièce jointe (facultative)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'mimeTypes' => [
                            'application/pdf',
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader un document valide (PDF, JPEG ou PNG)',
                    ])
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Créer le ticket',
                'attr' => ['class' => 'btn btn-primary']
            ])
            ->getForm();

        // Gère la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion du fichier uploadé
            $attachmentFile = $form->get('attachment')->getData();
            
            if ($attachmentFile) {
                $originalFilename = pathinfo($attachmentFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$attachmentFile->guessExtension();

                // Déplace le fichier dans le répertoire d'upload
                $attachmentFile->move(
                    $this->getParameter('tickets_directory'),
                    $newFilename
                );

                // Stocke le nom du fichier dans l'entité Ticket
                $ticket->setAttachment($newFilename);
            }

            // Enregistre le ticket en base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($ticket);
            $entityManager->flush();

            // Redirige avec un message de succès
            $this->addFlash('success', 'Votre ticket a été créé avec succès!');
            return $this->redirectToRoute('ticket_success');
        }

        // Affiche le formulaire
        return $this->render('ticket/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}