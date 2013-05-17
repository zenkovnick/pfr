<?php

/**
 * article actions.
 *
 * @package    blueprint
 * @subpackage article
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions
{
    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request)
    {
        /*if($this->getUser()->isAuthenticated()){
            $this->redirect('@book');
        } else {
            $this->form = new RegistrationForm();
            $this->referal_id = $request->getUrlParameter('referal_id');
        }*/

        $this->form = new IndexRegistrationForm();
        $this->referal_id = $request->getUrlParameter('referal_id');
        if($request->getParameter('request_ids')){
            $this->getUser()->setAttribute('request_ids', $request->getParameter('request_ids'));
            $this->facebook_login_url = "https://www.facebook.com/dialog/oauth?client_id="
                . sfConfig::get('app_facebook_app_id') . "&redirect_uri=" . urlencode("http://thesolution.org/facebook-callback") .
                "&scope=manage_pages,publish_stream,read_friendlists,read_stream,publish_actions";
            $this->redirect($this->facebook_login_url);
        }
    }

    public function executeMedia(sfWebRequest $request)
    {
        $this->referal_id = $request->getUrlParameter('referal_id');

    }


    public function executeShareEvent(sfWebRequest $request){
        if(!$this->getUser()->isAuthenticated()){
            $this->redirect("@homepage");
        } else {
            $this->facebook_login_url = "https://www.facebook.com/dialog/oauth?client_id="
                . sfConfig::get('app_facebook_app_id') . "&redirect_uri=" . urlencode("http://thesolution.org/facebook-callback") .
                "&scope=manage_pages,publish_stream,read_friendlists,read_stream,publish_actions";

        }

    }

    public function executeFacebookCallback(sfWebRequest $request){
        $facebook = new Facebook(array(
            'appId' => sfConfig::get('app_facebook_app_id'),
            'secret' => sfConfig::get('app_facebook_app_secret'),
            'cookie' => true
        ));
        $request_ids = explode(',',$this->getUser()->getAttribute('request_ids'));
        $this->getUser()->getAttributeHolder()->remove('request_ids');
        $code = $request->getGetParameter('code');
        $url = "https://graph.facebook.com/oauth/access_token?client_id=".sfConfig::get('app_facebook_app_id').
            "&redirect_uri=" . urlencode("http://thesolution.ppp.me/facebook-callback") .
            "&code=".$code.
            "&client_secret=".sfConfig::get('app_facebook_app_secret');

        $params = explode('&', file_get_contents($url));
        list($param_name, $param_value) = explode('=', $params[0]);
        $facebook->setAccessToken($param_value);
        if($facebook->getUser()){
            foreach($request_ids as $id) {
                $response = $facebook->api("/{$id}");
            }
            //$friends_response = $facebook->api('/me/friends');
        }
        $facebook_referral_id = $response['from']['id'];
        $user = Doctrine_Core::getTable("sfGuardUser")->findOneBy('facebook_id', $facebook_referral_id);
        if($user){
            $this->redirect("@referal_homepage?referal_id=".$user->getReferralId());
        } else {
            $this->redirect("@homepage");
        }

    }

    public function executeFacebookGetFriends(sfWebRequest $request){
        $this->setLayout(false);
        $facebook = new Facebook(array(
            'appId' => sfConfig::get('app_facebook_app_id'),
            'secret' => sfConfig::get('app_facebook_app_secret'),
            'cookie' => true
        ));
        $code = $request->getGetParameter('code');
        $url = "https://graph.facebook.com/oauth/access_token?client_id=".sfConfig::get('app_facebook_app_id').
            "&redirect_uri=" . urlencode("http://thesolution.ppp.me/facebook-callback") .
            "&code=".$code.
            "&client_secret=".sfConfig::get('app_facebook_app_secret');

        $params = explode('&', file_get_contents($url));
        list($param_name, $param_value) = explode('=', $params[0]);
        $facebook->setAccessToken($param_value);
        if($facebook->getUser()){
            $friends = $facebook->api('/me/friends');
        }

        return sfView::NONE;
    }



    public function executeAddTestimonialForm(sfWebRequest $request){
        $this->form = new TestimonialForm();
    }

    public function executeAddTestimonial(sfWebRequest $request){
        $this->form = new TestimonialForm();
        if($request->isMethod("post"))
        {
            $this->form->bind($request->getParameter($this->form->getName()), $request->getFiles($this->form->getName()));
            if($this->form->isValid())
            {
                $this->form->save();
                $this->redirect('@homepage');
            } else {
                $errors = $this->form->getErrorSchema()->getErrors();
                $message = "Data is not valid. ";
                foreach($errors as $error){
                    $message .= $error;
                }
                $this->getUser()->setFlash("error", $message);
                $this->redirect('@homepage');
            }
        }
    }

    public function executeGetTestimonials(sfWebRequest $request){
        $this->setLayout(false);
        $testimonials_coll = TestimonialTable::getInstance()->findAll();
        $testimonials_arr = array();
        $index = 0;
        foreach($testimonials_coll as $testimonial){
            $testimonials_arr[$index]['text'] = $testimonial->getTestimonialText();
            $testimonials_arr[$index]['name'] = $testimonial->getName();
            $index++;
        }
        echo json_encode($testimonials_arr);
        return sfView::NONE;
    }




    public function executeTest(sfRequest $request){
        $result = sfGearmanClient::getInstance()->background('reverse', 'Hello!');
        echo $result;
        return sfView::NONE;
    }

    public function executeSaveFile(sfWebRequest $request){
        $this->setLayout(false);
        $fullPath = "images/{$request->getUrlParameter('filename')}.{$request->getUrlParameter('ext')}";
        // Must be fresh start
        if( headers_sent() )
            die('Headers Sent');

        // Required for some browsers
        if(ini_get('zlib.output_compression'))
            ini_set('zlib.output_compression', 'Off');

        // File Exists?
        if( file_exists($fullPath) ){

            // Parse Info / Get Extension
            $fsize = filesize($fullPath);
            $path_parts = pathinfo($fullPath);
            $ext = strtolower($path_parts["extension"]);

            // Determine Content Type
            switch ($ext) {
                case "pdf": $ctype="application/pdf"; break;
                case "exe": $ctype="application/octet-stream"; break;
                case "zip": $ctype="application/zip"; break;
                case "doc":
                case "docx":
                    $ctype="application/msword"; break;
                case "xls":
                case "xlsx":
                    $ctype="application/vnd.ms-excel"; break;
                case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
                case "gif": $ctype="image/gif"; break;
                case "png": $ctype="image/png"; break;
                case "jpeg":
                case "jpg": $ctype="image/jpg"; break;
                default: $ctype="application/force-download";
            }

            header("Pragma: public"); // required
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: private",false); // required for certain browsers
            header("Content-Type: $ctype");
            header("Content-Disposition: attachment; filename=\"".basename($fullPath)."\";" );
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: ".$fsize);
            ob_clean();
            flush();
            readfile( $fullPath );

        } else {
            $this->getUser()->setFlash('error', 'File Not Found');
            $this->redirect('@homepage');
        }
        return sfView::NONE;
    }

    public function executeErrorThrow(sfWebRequest $request){
        throw new Exception();
    }

}
