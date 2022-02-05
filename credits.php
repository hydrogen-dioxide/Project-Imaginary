<!DOCTYPE html>

<html>
  <head>
  <?php
  function includeHeader($id="", $title="", $nav="") {
    include($_SERVER['DOCUMENT_ROOT']."/head.php");
  }
  includeHeader("credits", "Credits", "credits"); ?>
  </head>

<html>
  <body>
  <div id="header"></div>
  <main>
  <h1> <img class="page-icon" src="/assets/image/icon_credits.png"> Credits </h1>
  <section>
    <h2> Supporters </h2>
    <div class="table-container">
      <table>
        <tbody>
          <tr>
            <td> Mr. Haye Chan </td>
          </tr>

          <tr>
            <td> Mr. Lau </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
  <section>
    <h2> Developers </h2>
    <div class="table-container">
      <table>
        <tbody>
          <tr>
            <td> __ </td>
            <td> Daniel Hsieh </td>
          </tr>

          <tr>
            <td> Frontend (Water-washing) </td>
            <td> Jack Wong </td>
          </tr>

          <tr>
            <td> __ </td>
            <td> Duncan Ng </td>
          </tr>

          <tr>
            <td> __ </td>
            <td> Ryan Chan </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>
  </main>
  <div id="footer"></div>
  </body>
</html>