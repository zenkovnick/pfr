<?php

class updateFlightTask extends sfBaseTask
{
    protected function configure()
    {
        // // add your own arguments here
        // $this->addArguments(array(
        //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
        // ));

        $this->addOptions(array(
            new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name'),
            new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
            new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
            // add your own options here
        ));

        $this->namespace        = 'pfr';
        $this->name             = 'update-flight';
        $this->briefDescription = '';
        $this->detailedDescription = <<<EOF
The [generatorUsers|INFO] task does things.
Call it with:

  [php symfony generatorUsers|INFO]
EOF;
    }

    protected function execute($arguments = array(), $options = array())
    {

        $configuration = ProjectConfiguration::getApplicationConfiguration('frontend', 'prod', true);
        $context = sfContext::createInstance($configuration);
        $connection = $context->getDatabaseManager()->getDatabase($options['connection'])->getDoctrineConnection();

        try
        {
            $connection->beginTransaction();
            $flights = FlightTable::getInstance()->findAll();
            foreach($flights as $flight){
                $user = sfGuardUserTable::getInstance()->find($flight->getPicId());
                $flight->setPilotName($user->getFirstName());
                $flight->save();
            }
            $connection->commit();
            $this->logSection('UpdateFlight', "Update has successfully completed!!!");

        }
        catch (Exception $e)
        {
            $this->logSection('UpdateFlight', "Error. {$e->getMessage()}");
            $this->logSection('UpdateFlight', "Update has completed with errors");
            $connection->rollBack();
        }

    }

}
