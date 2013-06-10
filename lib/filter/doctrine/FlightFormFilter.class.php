<?php

/**
 * Flight filter form.
 *
 * @package    blueprint
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class FlightFormFilter extends BaseFlightFormFilter
{
    private $date_choice = array('' => 'all time', 'today' => 'today', 'yesterday' => 'yesterday', 'week' => 'last week', 'month' => 'last month', 'half_year' => 'last 6 month', 'year' => 'year');

    public function configure()
    {

        $this->widgetSchema['plane'] = new sfWidgetFormDoctrineChoiceCustom(array(
            'model' => 'Plane',
            'table_method' => 'getPlanes',
            'table_method_parameters' => array('account' => $this->getOption('account')),
            'add_empty' => 'all planes'
        ));
        $this->widgetSchema['pilot'] = new sfWidgetFormDoctrineChoiceCustom(array(
            'model' => 'sfGuardUser',
            'table_method' => 'getUsers',
            'table_method_parameters' => array('account' => $this->getOption('account')),
            'method' => 'getUserTitle',
            'method_parameters' => array('curr_user' => $this->getOption('user')),
            'add_empty' => 'all pilots'
        ));
        $this->widgetSchema['date'] = new sfWidgetFormChoice(array('choices' => $this->date_choice));


        $this->validatorSchema['plane'] = new sfValidatorPass();
        $this->validatorSchema['pilot'] = new sfValidatorPass();

        $this->widgetSchema->setNameFormat("flight_filter[%s]");
    }

    public function getQuery()
    {
        $query = Doctrine_Query::create()
            ->select("f.*, a.*")
            ->from("Flight f")
            ->leftJoin("f.Account a")
            ->leftJoin('f.PIC pic')
            ->leftJoin('f.SIC sic')
            ->leftJoin('f.Plane p')
            ->where('f.account_id = ?', $this->getOption('account')->getId());


        if (isset($this->defaults['plane']) && $this->defaults['plane'] != '')
        {
            $query->andWhere("f.plane_id = ?", $this->defaults['plane']);
        }
        if (isset($this->defaults['pilot']) && $this->defaults['pilot'] != '')
        {
            $query->andWhere("f.pic_id = ? OR f.pic_id = ?", array($this->defaults['pilot'], $this->defaults['pilot']));
        }
        if (isset($this->defaults['date']) && $this->defaults['date'] != '')
        {
            switch($this->defaults['date']){
                case 'today':
                    $query->andWhere("f.created_at >= CURDATE()");
                    break;
                case 'yesterday':
                    $query->andWhere("f.created_at >= date_sub(CURDATE(), interval 1 day)");
                    break;
                case 'week':
                    $query->andWhere("f.created_at >= date_sub(CURDATE(), interval 1 week)");
                    break;
                case 'month':
                    $query->andWhere("f.created_at >= date_sub(CURDATE(), interval 1 month)");
                    break;
                case 'half_year':
                    $query->andWhere("f.created_at >= date_sub(CURDATE(), interval 6 month)");
                    break;
                case 'year':
                    $query->andWhere("f.created_at >= date_sub(CURDATE(), interval 1 year)");
                    break;
            }
        }


        if (isset($this->defaults['sort']))
        {
            if($this->defaults['sort']['column'] == 'company')
                $query->orderBy("c.title ".$this->defaults['sort']['order']);
            elseif($this->defaults['sort']['column'] == 'city')
                $query->orderBy("ct.name ".$this->defaults['sort']['order']);
            elseif($this->defaults['sort']['column'] == 'industry')
                $query->orderBy("industries ".$this->defaults['sort']['order']);
            else
                $query->orderBy($this->defaults['sort']['column']." ".$this->defaults['sort']['order']);
        }

        return $query;
    }
}
