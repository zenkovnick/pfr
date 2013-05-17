<?php

class generatorUsersTask extends sfBaseTask
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

    $this->namespace        = 'thesolution';
    $this->name             = 'genusers';
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
          $users = array();
          for($i=1; $i<500000; $i++){
              $user = new sfGuardUser();
              $user->setUsername("user-{$i}@test.org");
              $user->setPassword("111111");
              $user->save();

              $tree_obj = Doctrine_Core::getTable('sfGuardUser')->getTree();
              if(!$users){
                  $tree_obj->createRoot($user);
                  $users[] = $user;
                  $this->logSection('GenerateUsers', "user-{$i}@test.org is root and has referers");
              } else {
                  if(mt_rand(1, 100) <= 10){
                      $tree_obj->createRoot($user);
                      if(mt_rand(1, 100) > 20){
                          $users[] = $user;
                          $this->logSection('GenerateUsers', "user-{$i}@test.org is root with referers");
                      } else {
                          $this->logSection('GenerateUsers', "user-{$i}@test.org is root without referers");
                      }
                  } else {
                      $parent_user_key = array_rand($users);
                      $parent_user = $users[$parent_user_key];
                      $user->getNode()->insertAsLastChildOf($parent_user);
                      if(mt_rand(1, 100) > 20){
                          $users[] = $user;
                          $this->logSection('GenerateUsers', "user-{$i}@test.org with referers");
                      } else {
                          $this->logSection('GenerateUsers', "user-{$i}@test.org without referers");
                      }
                  }
              }
          }

          $connection->commit();
          $this->logSection('GenerateUsers', "Generation complete!!!");

      }
      catch (Exception $e)
      {
          $this->logSection('GenerateUsers', "Error. {$e->getMessage()}");
          $this->logSection('GenerateUsers', "Generation complete with errors");
          $connection->rollBack();
      }

  }

}
