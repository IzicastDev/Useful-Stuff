<?php 
  session_start();


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <!--  This file has been downloaded from bootdey.com @bootdey on twitter -->
    <!--  All snippets are MIT license http://bootdey.com/license -->
    <title>404 error page with blur - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<section class="p-0 bg-img cover-background" style="background-image: url(https://bootdey.com/img/Content/bg1.jpg);">
        <div class="container-fluid d-flex flex-column">
            <div class="row align-items-center justify-content-center min-vh-100">
                <div class="col-md-9 col-lg-6 my-5">
                    <div class="text-center error-page">
                        <h1 class="mb-0 text-secondary">404</h1>
                        <h2 class="mb-4 text-white">Sorry, something went wrong!</h2>
                        <p class="w-sm-80 mx-auto mb-4 text-white">This page is incidentally inaccessible because of support. We will back very before long much obliged for your understanding</p>
                        <div>
                            <a href="#" class="btn btn-info btn-lg me-sm-2 mb-2 mb-sm-0">Return Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<style type="text/css">
body{margin-top:20px;}
.cover-background {
    position: relative !important;
    background-size: cover !important;
    overflow: hidden !important;
    background-position: center !important;
    background-repeat: no-repeat !important;
}
.p-0 {
    padding: 0!important;
}
section {
    padding: 120px 0;
    overflow: hidden;
    background: #fff;
}

.error-page {
    background-color: #BABABA4A;
    -webkit-backdrop-filter: blur(9px);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(234,234,235,0.2);
    padding: 80px 20px;
}
.text-center {
    text-align: center!important;
}
.error-page h1 {
    font-size: 200px;
    line-height: 1;
    font-weight: 600;
}
.text-secondary {
    color: #15395A !important;
}
.mb-4 {
    margin-bottom: 1.5rem!important;
}
</style>

<script type="text/javascript">

</script>
</body>
</html>