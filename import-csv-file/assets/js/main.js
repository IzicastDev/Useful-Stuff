$(document).ready(function(){
  $('#upload_csv').on('submit', function(event){
   event.preventDefault();
   $.ajax({
    url:"fetch.php",
    method:"POST",
    data:new FormData(this),
    dataType:'json',
    contentType:false,
    cache:false,
    processData:false,
    success:function(data)
    {
     var html = '<table class="table table-striped table-bordered">';
     if(data.column)
     {
      html += '<tr>';
      for(var count = 0; count < data.column.length; count++)
      {
       html += '<th>'+data.column[count]+'</th>';
      }
      html += '</tr>';
     }
 
     if(data.row_data)
     {
      for(var count = 0; count < data.row_data.length; count++)
      {
       html += '';
       html += '<td class="speaker_id" contenteditable>'+data.row_data[count].speaker_id+'</td>';
       html += '<td class="speaker_firstName" contenteditable>'+data.row_data[count].speaker_firstName+'</td>';
       html += '<td class="speaker_lastName" contenteditable>'+data.row_data[count].speaker_lastName+'</td>';
       html += '<td class="speaker_title" contenteditable>'+data.row_data[count].speaker_title+'</td>';
       html += '<td class="speaker_company" contenteditable>'+data.row_data[count].speaker_company+'</td>';
       html += '<td class="speaker_position" contenteditable>'+data.row_data[count].speaker_position+'</td>';
       html += '<td class="speaker_description" contenteditable>'+data.row_data[count].speaker_description+'</td>';
       html += '<td class="speaker_image" contenteditable>'+data.row_data[count].speaker_image+'</td>';
       html += '<td class="speaker_sessionSubject" contenteditable>'+data.row_data[count].speaker_sessionSubject+'</td></tr>';
      }
     }
     html += '<table>';
     html += '<div align="center"><button type="button" id="import_data" class="btn btn-success">Import</button></div>';
 
     $('#csv_file_data').html(html);
     $('#upload_csv')[0].reset();
    }
   })
  });
 
 
  $(document).on('click', '#import_data', function(){
   // INIT vars
     var speaker_id = [];
     var speaker_firstName = [];
     var speaker_lastName = [];
     var speaker_title = [];
     var speaker_company = [];
     var speaker_position = [];
     var speaker_description = [];
     var speaker_image= [];
     var speaker_sessionSubject = [];
   
   
   // Push values to send to database
     $('.speaker_id').each(function(){
      speaker_id.push($(this).text());
     });
     
     $('.speaker_firstName').each(function(){
      speaker_firstName.push($(this).text());
     });
     
     $('.speaker_lastName').each(function(){
        speaker_lastName.push($(this).text());
     });
     
     $('.speaker_title').each(function(){
      speaker_title.push($(this).text());
     });
     
     $('.speaker_company').each(function(){
      speaker_company.push($(this).text());
     });
     
     $('.speaker_position').each(function(){
      speaker_position.push($(this).text());
     });
     
     $('.speaker_description').each(function(){
      speaker_description.push($(this).text());
     });
     
     $('.speaker_image').each(function(){
      speaker_image.push($(this).text());
     });
     
     $('.speaker_sessionSubject').each(function(){
      speaker_sessionSubject.push($(this).text());
     });
     
     
  // send data    
   $.ajax({
    url:"import.php",
    method:"post",
    data:{  speaker_id: speaker_id, 
            speaker_firstName: speaker_firstName,
            speaker_lastName: speaker_lastName,
            speaker_title: speaker_title,
            speaker_company: speaker_company,
            speaker_position: speaker_position,
            speaker_description: speaker_description,
            speaker_image: speaker_image,
            speaker_sessionSubject: speaker_sessionSubject
        },
    success:function(data)
    {
      /** data returns
          {
             "success":0,
             "message":"SQLSTATE[23000]: Integrity constraint violation: 1062 Duplicate entry '1' for key 'PRIMARY'",
             "code":"23000",
             "file":"\/Applications\/XAMPP\/xamppfiles\/htdocs\/izi\/Useful-Stuff\/import-csv-file\/assets\/utils\/Database.php",
             "line":69
          }
      */
      if (data == "Success") {
      // if file upload success
          html = '<div class="alert alert-success" role="alert">Data Imported Successfully to database</div>';
      } 
      else { 
      // file not uploaded
          html  = '<div class="alert alert-danger" role="alert">' + data; 
          html += '<br><h3 class="text-dark"><strong>Please check if the database is empty</strong></h3></div>';
      }
      
      // Write to page
      $('#csv_file_data').html(html);
    }
   })
  });
 });