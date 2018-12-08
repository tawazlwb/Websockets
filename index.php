<html>
    <head>
        <meta charset="utf-8">
        <title>PHP and Jquery Chat Application</title>
        <link rel="stylesheet" href="./node_modules/bootstrap/dist/css/bootstrap.min.css" media="screen" title="no title" charset="utf-8">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <h2>PHP and Jquery Chat Application</h2>
                    <h3>Mesages</h3>
                    <ul class="messages-list">
                    
                    </ul>
                    <form class="chartForm" action="#" method="POST">
                        <div class="form-group">
                            <label for="messsage">message</label>
                            <textarea type="button" id="message" name="message" class="form-control" value=""></textarea>
                        </div>
                        <div class="">
                            <button type="submit" name="button" class="btn btn-primary pull-right" >Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="./node_modules/jquery/dist/jquery.min.js"></script>
    <script src="./node_modules/js-cookie/src/js.cookie.js"></script>
    <script src="./src/custom/main.js"></script>
</html>