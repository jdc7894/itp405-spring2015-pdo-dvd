<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet"  href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container auth">
    <h1 class="text-center">DVD Search with PDO </h1>
    <div id="big-form" class="well auth-box">
        <form action="results.php" method="get">
        <fieldset>
          <div class="form-group">
            <label class=" control-label">DVD Title</label>
            <div class="">
                    <input type="text" class="form-control" name="dvd_name" id="input_title">
            </div>
          </div>

          <div class="form-group" align="center">
            <div class="">
              <button id="singlebutton" name="singlebutton" class="btn btn-primary">Search DVD</button>
            </div>
          </div>
        </fieldset>
      </form>
    </div>
    <div class="clearfix"></div>
  </div>
</body>
</html>