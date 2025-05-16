<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Upload File</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Arial', sans-serif;
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .upload-box {
      background-color: #ffffff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    h3 {
      color: #333;
      margin-bottom: 25px;
    }

    input[type="file"] {
      display: block;
      margin: 0 auto 20px auto;
      padding: 10px;
      font-size: 16px;
      border-radius: 6px;
      border: 1px solid #ccc;
      width: 100%;
    }

    button {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="upload-box">
    <h3>Upload File</h3>
    <form action="/upload" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="file" name="document" />
      <button type="submit">Upload</button>
    </form>
  </div>
</body>
</html>
