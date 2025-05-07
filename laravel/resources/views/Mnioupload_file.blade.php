<html>
 <body>
 <h3>Upload File Minio</h3>
 <form action="/mini/upload" method="POST" enctype="multipart/form-data">
 @csrf
 <input type="file" name="document" />
 <button type="submit">Upload</button>
 </form>
 </body>
</html>