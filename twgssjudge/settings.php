<!DOCTYPE HTML>
<html>
  <head>
    <title> TWGSS Online Judge</title>
    <link rel="stylesheet" type="text/css" href="/style.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/assets/image/icon.png">

    <script id="MathJax-script" async src="https://cdn.jsdelivr.net/npm/mathjax@3/es5/tex-mml-chtml.js"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
      $(document).ready(function(){
      $("#header").load("/header.html", null, function () { $('.nav-settings').addClass('active'); });
      $("#footer").load("/footer.html");
      });
    </script>
    <script src="/assets/js/include.js"> </script>
    <script>
        function copy_code(id) {
            var copyText = document.getElementById(id).innerText;
            navigator.clipboard.writeText(copyText);
            sendNotification();
        }
    </script>
  <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>
<body>
  <div id="header"></div>
  <main>
	<h1> <img class="page-icon" src="/assets/image/icon_settings.png"> Settings</h1>
	<section>
    <h2> Basic Information </h2>
    <div class="table-container">
      <table>
        <tbody>
          <tr>
            <td> Username </td>
            <td> ryanchan </td>
          </tr>

          <tr>
            <td> Display Name </td>
            <td> <input> </td>
          </tr>

          <tr>
            <td> Real Name </td>
            <td> Chan Pak Hank </td>
          </tr>

          <tr>
            <td> Email Adress </td>
            <td> <input> </td>
          </tr>

          <tr>
            <td> Programming Language </td>
            <td>
              <select>
                <option value="cpp">C++</option>
                <option value="c">C</option>
                <option value="py">Python</option>
              </select>
            </td>
          </tr>

          <tr>
            <td> Colour Theme </td>
            <td>
              <input name="theme" type="radio" value=0>Light 
              <input name="theme" type="radio" value=0>Dark
            </td>
          </tr>

          <tr>
            <td> Language </td>
            <td>
              <input name="language" type="radio" value=0>English
              <input name="language" type="radio" value=0>繁體中文
            </td>
          </tr>
        </tbody>
      </table>
    </div>
	</section>

  <section>
	  <h2> Appearance </h2>
    <div class="table-container">
      <table>
        <tbody>
          <tr>
            <td> Profile Picture </td>
            <td> <input type="file" id="img" name="img" accept="image/*"> </td>
          </tr>

          <tr>
            <td> Personal Description </td>
            <td> <textarea name="sample-out[]" cols="30" rows="6" class="code" type="text" style="resize: none;" ></textarea> </td>
          </tr>
        </tbody>
      </table>
    </div>
	</section>

  <section>
	  <h2> Change Password </h2>
    <div class="table-container">
      <table>
        <tbody>
          <tr>
            <td> Old Password </td>
            <td> <input type="password"> </td>
          </tr>

          <tr>
            <td> New Password </td>
            <td> <input type="password"> </td>
          </tr>

          <tr>
            <td> Repeat New Password </td>
            <td> <input type="password"> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <button type="submit" id="confirm_pass"> Confirm Changes </button>
	<script>

		$('#confirm_pass').on('click', function(){
			Swal.fire({
				position: 'top-end',
				icon: 'success',
				title: 'Your password have been saved',
				showConfirmButton: false,
				timer: 1500
			})
		})
	</script>
  </main>
  <div id="footer"></div>
</body>
</html>