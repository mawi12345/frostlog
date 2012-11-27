<?php
namespace Mawi\Bundle\FrostlogBundle\Command;

use Mawi\Bundle\FrostlogBundle\Entity\User;

use Symfony\Component\Console\Helper\DialogHelper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;



class UserAddCommand extends ContainerAwareCommand
{
		
    protected function configure()
    {
        $this
            ->setName('frostlog:user:add')
            ->setDescription('adds an new user')
        ;
    }
    
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	    	
		$dialog = $this->getHelperSet()->get('dialog');
		if (!$dialog->askConfirmation(
				$output,
				'<question>Do you wont to add an new user (yes|no) [no]</question> ',
				false
		)) {
			return;
		}
		
		
		
		$dialog = $this->getHelperSet()->get('dialog');
		do {
			$name = $dialog->ask(
					$output,
					'Please enter the name of the user: '
			);
		} while (strlen($name) < 3);
		
		do {
		
			$email = $dialog->ask(
					$output,
					'Please enter the email: '
		
			);
		
		} while (strlen($email) < 4);
		
		do {

			$password = $dialog->askHiddenResponse(
					$output,
					'Please enter the password: '

			);

		} while (strlen($password) < 4);
		

		
		
		$sp = '';
		
		do {
			$sp .= '*';
		} while (strlen($password) > strlen($sp));
		
		$output->writeln('<info>Name:     '.$name.'</info>');
		$output->writeln('<info>Email:    '.$email.'</info>');
		$output->writeln('<info>Password: '.$sp.'</info>');
		
		if (!$dialog->askConfirmation(
				$output,
				'<question>Do you wont to store the new user? (yes|no) [yes]</question> ',
				true
		)) {
			return;
		}
		
		$user = new User();
		$user->setUsername($name);
		$user->setEmail($email);
		$user->setSalt(uniqid(mt_rand()));
		
		$factory = $this->getContainer()->get('security.encoder_factory');
		
		$encoder = $factory->getEncoder($user);
		$password = $encoder->encodePassword($password, $user->getSalt());
		$user->setPassword($password);
		
		
		$em = $this->getContainer()->get('doctrine')->getEntityManager();
		$em->persist($user);
		$em->flush();
		
		$output->writeln('user stored');
		
    }
}