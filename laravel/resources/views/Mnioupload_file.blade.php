<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upload File Minio</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f4f6f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .upload-container {
      background-color: white;
      padding: 30px 40px;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 400px;
      width: 100%;
    }

    h3 {
      margin-bottom: 20px;
      color: #333;
    }

    input[type="file"] {
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      margin-bottom: 20px;
      width: 100%;
      font-size: 16px;
    }

    button {
      background-color: #4caf50;
      color: white;
      border: none;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #45a049;
    }
  </style>
</head>
<body>
  <div class="upload-container">
    <h3>Upload File to MinIO</h3>
    <form action="/minio/upload" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="document" />
      <br />
      <button type="submit">Upload</button>
    </form>
  </div>
</body>
</html>
