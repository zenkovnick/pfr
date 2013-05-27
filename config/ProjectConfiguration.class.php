<?php

require_once dirname(__FILE__).'/../lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfDoctrinePlugin');
    $this->enablePlugins('sfDoctrineGuardPlugin');
    //$this->enablePlugins('sfJqueryReloadedPlugin');
    $this->enablePlugins('sfAdminDashPlugin');
    $this->enablePlugins('isicsWidgetFormTinyMCEPlugin');
    $this->enablePlugins('sfImageTransformPlugin');
    $this->enablePlugins('csDoctrineActAsSortablePlugin');
    $this->enablePlugins('sfThumbnailPlugin');
    $this->enablePlugins('vjBrowserDetectionPlugin');
    //$this->enablePlugins('sfGearmanPlugin');

    //./symfony gearman:worker --config=example1 --verbose --timeout=-1
  }
}
