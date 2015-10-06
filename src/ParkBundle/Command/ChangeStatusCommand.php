<?php
// src/AppBundle/Command/GreetCommand.php
namespace ParkBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ChangeStatusCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('ParkBundle:changeStatus')
            ->setDescription('Change status of computer')
            ->addArgument(
                'status',
                InputArgument::REQUIRED,
                'Status to store'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $newStatus = $input->getArgument('status');
        $em = $this->getContainer()->get('Doctrine')->getManager();
        $entity = $em->getRepository('ParkBundle:Computer')->findAll();
        if ($newStatus == "actif") {
            foreach($entity as $computer){
                $computer->setEnabled(true);
            }
            $em->flush();
            $text = "Tous les ordinateurs ont ete actives";
        } elseif($newStatus == "inactif") {
            foreach($entity as $computer){
                $computer->setEnabled(false);
            }
            $em->flush();
            $text = "Tous les ordinateurs ont ete desactives";

        }elseif($newStatus == "toggle") {
            foreach($entity as $computer){
                $computer->setEnabled(!($computer->getEnabled()));
            }
            $em->flush();
            $text = "Tous les ordinateurs ont change d'etat";

        } else {
            $text = "Probleme lors de l'execution de la commande (le statut doit etre actif ou inactif)";
        }

        $output->writeln($text);
    }
}