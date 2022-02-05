<!DOCTYPE html>

<html>
<head>
<?php 
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("problem/$problemID/submit", "Problem Submit", "problems");
?>
</head>
<body>
  <div id="header"></div>
  <main>
	<h1> <img class="page-icon" src="/assets/image/icon_submit.svg"> Problem Submit </h1>
  <form action="/php/submit_code.php" enctype="multipart/form-data" method="POST">
    <input style="display: none;" type="text" name="userID" value="0">
    <input style="display: none;" type="text" name="problemID" value="<?php echo $problemID; ?>">
    

    <div class="table-container">
      <table>
        <tbody>
          <tr>
            <td>Problem ID</td>
            <td><?php echo $problemID; ?></td>
          </tr>

          <tr>
            <td><label for="language">Language</label></td>
            <td>
              <select name="language" id="language">
                <option value="C">C</option>
                <option value="C++20">C++20</option>
                <option value="Python">Python</option>
              </select>
            </td>
          </tr>

          <tr>
            <td><label for="source_code_file">Source Code</label></td>
            <td><input style="border: none;" type="file" id="source_code_file" name="source_code_file" /></td>
          </tr>
        </tbody>
      </table>
    </div>

    <textarea name="source_code_text" cols="80" rows="20" class="code" type="text" style="resize: none; tab-size: 2;" ></textarea>

    <br>
    
    <script src="/assets/js/code_style.js"></script>
    
    <button class="btn save" name="submit" type="submit"> Submit </button>
  </form>
  </main>
  <div id="footer"></div>
</html>