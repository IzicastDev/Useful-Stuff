<?php
  session_start();
  
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);

  require_once "assets/utils/utils.php";

?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Import CSV file</title>
  <!-- BOOTSTRAP -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome 6.1.1 -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
  <!-- my CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- Jquery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

 
</head>
<body>
  
  <?php include_once "assets/includes/header.php"; ?>
  
  <!-- Open file -->
  <div class="container">
    <div class="row">
      <div class="col-12">
        <h3 class="text-center mt-4 mb-3">CSV file Editing and Import in PHP</h3>
        
        <form id="upload_csv" action="POST" enctype="multipart/form-data" class="alert alert-secondary" role="alert">
          <div class="d-flex  align-items-center justify-content-around">
              <div >
                <label for="" class="bold">Select CSV file</label>
              </div>
              <div >
                <input type="file" name="csv_file" id="csv_file" accept=".csv" >
              </div>
              <div >
                <input type="submit" name="upload" id="upload" value="Upload" class="btn btn-info">
                <button class="btn btn-outline-info btn-sm" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    <i class="fa-solid fa-info"></i>
                </button>
              </div>
          </div><!-- end d-flex -->
          <div style="clear: both;"></div>
        </form>
        
      </div><!-- end col -->
    </div><!-- end row -->
    
    <!-- INFO -->
    <div class="row ">
      <div class="col-12">
        <div class="collapse" id="collapseExample">
          <div class="card card-body text-bg-warning" style="--bs-bg-opacity: .3;">
            <h3 class="text-center">The file structure needs to be:</h3>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">id</th>
                  <th scope="col">firstName</th>
                  <th scope="col">lastName</th>
                  <th scope="col">title</th>
                  <th scope="col">company</th>
                  <th scope="col">position</th>
                  <th scope="col">description</th>
                  <th scope="col">image</th>
                  <th scope="col">sessionSubject</th>                
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Mark</td>
                  <td>Otto</td>
                  <td></td>
                  <td>The Sandbox</td>
                  <td>Co-founder & Chief Operating Officer</td>
                  <td></td>
                  <td><img src="assets/images/placeholders/photo_500x375.png" alt="" width="100px"></td>
                  <td>Modern Theming & The Future of WordPress: Working with Full Site Editing and Beyond</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>( .. )</td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                  <td></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- SHOW content of the file -->
    <div class="row">
      <div id="csv_file_data"></div>
    </div>
    
  </div><!-- end container -->
  

  
  
<!-- BOOSTRAP JS -->  
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js"></script>
<!-- jquery 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>-->
<!-- myJAVASCRIPT -->
<script src="assets/js/main.js"></script>
</body>
</html>