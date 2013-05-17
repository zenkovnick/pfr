<html>
    <head>
        <title>The Solution. Something wrong went on server</title>
        <script type="text/javascript" src="/js/jquery-1.8.3.js">
        </script>
        <script type="text/javascript">
            jQuery(document).ready(function(){
                jQuery.ajax({
                    url: '/notification/error-notification',
                    async: true,
                    type: 'POST',
                    success: function(data){

                    }
                });
            });
        </script>
        <style type="text/css" >
            .error-page {
                position: relative;
                overflow: visible !important;
            }

            .error-page div.error-page-wrapper {
                height: 250px;
                width: 680px;
                position: relative;
                margin: 0 auto 0;
                padding: 150px 0;
            }

            div.error-page-wrapper h1{
                font: 54px/120% 'Titillium Web';
                color: #777;
            }

            div.error-page-wrapper div.error-code-status{
                margin-top: 100px;
                font: 900 54px/120% 'Titillium Web';
            }

            div.error-code-status span.error-code{
                color: #212121;
            }

            div.error-code-status span.error-code-message, a{
                color: #7F24BD;
            }

            div.error-message span.error-status-message {
                font: 20px/120% 'Titillium Web';
                color: #666666;
            }
        </style>

    </head>
    <body>
        <div class="wrapper error-page">
            <div class="error-page-wrapper">
                <h1>OOPS!..&nbsp;&nbsp;&nbsp;:(</h1>
                <div class="error-code-status">
                    <span class="error-code">ERROR 500</span><br />
                    <span class="error-code-message">Internal Server Error</span>
                </div>
                <div class="error-message">
                    <span class="error-status-message">Something went wrong on server. Please, contact <a href="Support@TheSolution.org">Support@TheSolution.org</a></span>
                </div>
            </div>
        </div>

    </body>
</html>
