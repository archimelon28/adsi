 <!-- container --> 
 <!DOCTYPE html>
 <html>
 <head>
   <title></title>
 </head>
 <body>
    <section class="showcase">
    <div class="container">
      <div class="pb-2 mt-4 mb-2 border-bottom">
        <h2>Import Data to Excel and CSV file using PhpSpreadsheet library in CodeIgniter and MySQL</h2>
      </div>
    
    <h3>Matkul</h3>
    <form action="<?php print site_url();?>/C_Matkul/upload" class="excel-upl" id="excel-upl" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="row padall">
        <div class="col-lg-6 order-lg-1">
          
          <input type="file" class="custom-file-input" id="validatedCustomFile" name="fileURL">
          <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
        </div>
        <div class="col-lg-6 order-lg-2">
          <button type="submit" name="import" class="float-right btn btn-primary">Import</button>
        </div>
      </div>
    </form>

    <h3>Kelas</h3>
    <form action="<?php print site_url();?>/C_Kelas/upload" class="excel-upl" id="excel-upl" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="row padall">
        <div class="col-lg-6 order-lg-1">
          
          <input type="file" class="custom-file-input" id="validatedCustomFile" name="fileURL">
          <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
        </div>
        <div class="col-lg-6 order-lg-2">
          <button type="submit" name="import" class="float-right btn btn-primary">Import</button>
        </div>
      </div>
    </form>

    <h3>Ruangan</h3>
    <form action="<?php print site_url();?>/C_Ruang/upload" class="excel-upl" id="excel-upl" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="row padall">
        <div class="col-lg-6 order-lg-1">
          
          <input type="file" class="custom-file-input" id="validatedCustomFile" name="fileURL">
          <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
        </div>
        <div class="col-lg-6 order-lg-2">
          <button type="submit" name="import" class="float-right btn btn-primary">Import</button>
        </div>
      </div>
    </form>

    </div>
  </section>
 </body>
 </html>
  