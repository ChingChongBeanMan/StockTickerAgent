<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{title}</title>
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="screen"/>
        <link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
	  integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" 
	  crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
                {menubar}          
            <div id="content">
				<div class="jumbotron">
					<h1>JIM WHY U DO DIS</h1>
					<ul class="list-inline">
						<li><p><a class="btn btn-primary btn-lg" href="#" role="button">Stocks</a></p></li>
						<li><p><a class="btn btn-primary btn-lg" href="#" role="button">Users</a></p></li> 
                        <li>{login-menu}</li>
					</ul>
				</div>
                {content}
            </div>
            <div id="footer" class="span12">
                Copyright &copy; 2015-2016,  <a href="mailto:someone@somewhere.com">Me</a>.
            </div>
        </div>
        <script src="/assets/js/jquery-1.11.1.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
    </body>
</html>
