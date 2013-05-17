<?php include_component('menu', 'member_menu', array('active' => '', 'refer_link' => url_for('@book'))) ?>
<?php slot('title', "The Solution - Share Event Via Facebook") ?>

<div id="fb-root"></div>
<script>
    var data = null;
    var friends_ids_str = "";
    var friends_ids = null;
    function fb_init(){
        window.fbAsyncInit = function() {
            // init the FB JS SDK
            FB.init({
                appId      : '182001591950448', // App ID from the App Dashboard
                channelUrl : '//thesolution.org/share-event', // Channel File for x-domain communication
                status     : true, // check the login status upon init?
                cookie     : true, // set sessions cookies to allow your server to access the session?
                xfbml      : true  // parse XFBML tags on this page?
            });

            FB.getLoginStatus(function(response){
                //alert(response.status);
                /**/
                if (response.status === 'connected') {
                    // connected
                    testAPI();
                } else if (response.status === 'not_authorized') {
                    // not_authorized
                    login();
                } else {
                    // not_logged_in
                    login();
                }
            });

            // Additional initialization code such as adding Event Listeners goes here

        };

        function login() {
            FB.login(function(response) {
                if (response.authResponse) {
                    // connected
                    testAPI();
                } else {
                    // cancelled
                }
            });
        }

        function testAPI(){
            friends_ids = new Array;
            FB.api('/me/friends', function(response) {
                if(response.data) {
                    $.each(response.data,function(index,friend) {
                        friends_ids.push(friend.id);

                        //alert(friend.name + ' has id:' + friend.id);
                    });
                    friends_ids_str = friends_ids.join(',');
                } else {
                    alert("Error!");
                }
            });
        }

        // Load the SDK's source Asynchronously
        // Note that the debug version is being actively developed and might
        // contain some type checks that are overly strict.
        // Please report such bugs using the bugs tool.
        (function(d, s, id, debug){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/all" + (debug ? "/debug" : "") + ".js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk', /*debug*/ true));
    }
</script>

<div class="wrapper share-event">
    <h1>Share Event</h1>

    <a href="<?php echo url_for("@blog") ?>">No, Thanks</a>
    <a href="<?php echo $facebook_login_url ?>">Share</a>
    <a href="" class="share">Share2</a>

</div>
<script type="text/javascript">
    fb_init();

    jQuery(document).ready(function(){
        jQuery('a.share').click(function(event){
           event.preventDefault();
           /*jQuery.ajax({
              url: '<?php echo url_for("@get_friends") ?>',
               type: "GET",
               dataType: 'json',
               async: true,
               success: function(data){

               }
           });*/
           //alert(friends_ids_str);
           send_invitation(friends_ids_str);
           //send_feed(friends_ids_str);
       })

    });

    function send_invitation(fb_frnd_id){
        FB.ui({ method: 'apprequests',
            message: 'I want invite you to TheSolution',
            link: 'http://thesolution.org'
        });
    }




    function send_feed(fb_frnd_id){
        FB.ui(
            {
                method: 'feed',
                name: 'Facebook Dialogs',
                redirect_uri: 'http://thesolution.org/facebook-callback',
                link: 'http://developers.facebook.com/docs/reference/dialogs/',
                picture: 'http://fbrell.com/f8.jpg',
                caption: 'Reference Documentation',
                description: 'Dialogs provide a simple, consistent interface for applications to interface with users.',
                to: [27700937,33301159,505386965]
            },
            function(response) {
                if (response && response.post_id) {
                    alert('Post was published.');
                } else {
                    alert('Post was not published.');
                }
            }
        );
    }
</script>