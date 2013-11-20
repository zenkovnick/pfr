<?php

/**
 * reports actions.
 *
 * @package    blueprint
 * @subpackage reports
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class reportsActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
      $account_id = $request->getParameter('account_id');
      if(!sfGuardUserTable::checkUserAccountAccess($account_id, $this->getUser()->getGuardUser()->getId())){
          $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
      }
      $this->account = Doctrine_Core::getTable('Account')->find($account_id);
      $this->can_manage = $this->getUser()->getGuardUser()->canManage($this->account);
      if(!$request->isXmlHttpRequest()){
          $this->report_type = 'account';

      } else {
          $this->setLayout(false);
          $html = $this->getComponent('reports', 'showReport', array(
              'account' => $this->account,
              'report_type' => $request->getParameter('report_type'),
              'option_id' =>  $request->getParameter('id'),
              'date_type' => $request->getParameter('date_type'),
              'date_from' => $request->getParameter('date_from'),
              'date_to' => $request->getParameter('date_to')
          ));
          echo json_encode(array('result' => 'OK', 'html' => $html));
          return sfView::NONE;
      }
  }

  public function executeGetReportOptions(sfWebRequest $request){
      $this->setLayout(false);
      $account_id = $request->getParameter('account_id');
      if(!sfGuardUserTable::checkUserAccountAccess($account_id, $this->getUser()->getGuardUser()->getId())){
          $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
      }
      $account = Doctrine_Core::getTable('Account')->find($account_id);
      $options = $account->getAdditionalOptions($request->getParameter('report_type'));
      $html = $this->getPartial('reports/additionalOptions', array('options' => $options));
      echo json_encode(array('result' => 'OK', 'html' => $html));
      return sfView::NONE;
  }

  public function executeGetPDF(sfWebRequest $request){
      $response = $this->getResponse();
      $response->clearHttpHeaders();
      $account_id = $request->getParameter('account_id');
      if(!sfGuardUserTable::checkUserAccountAccess($account_id, $this->getUser()->getGuardUser()->getId())){
          $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
      }
      $this->account = Doctrine_Core::getTable('Account')->find($account_id);

      $html = $this->getComponent('reports', 'showReport', array(
          'account' => $this->account,
          'report_type' => $request->getParameter('report_type'),
          'option_id' =>  $request->getParameter('id'),
          'date_type' => $request->getParameter('date_type'),
          'date_from' => $request->getParameter('date_from'),
          'date_to' => $request->getParameter('date_to')
      ));

      $pdf = new DOMPDF();
      $pdf->load_html($html);
      $pdf->render();
      ob_end_flush();
      $pdf->stream("hello.pdf");
  }



}
