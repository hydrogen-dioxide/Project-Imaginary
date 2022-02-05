<?php
  function tbl($test, $a){ if (!$test) return; return $a; }
  function settingRow($id, $type, $data, $default, $label, $t=true){
    if ($type == "checkbox"){
      $output = tbl($t, "<tr>");
      $output .= tbl($t, "<td>")."<label for=$id>$label</label>".tbl($t, "</td>");
      $output .= tbl($t, "<td class='setting-cell'>");
      for ($i=0; $i<count($data); $i++){
        $output .= $data[$i]."<br>";
      }
      $output .= tbl($t, "</td></tr>");
      return $output;
    }

    $output = tbl($t, "<tr>");
    $output .= tbl($t, "<td>")."<label for=$id>$label</label>".tbl($t, "</td>");
    if ($type == "text" || $type == "datetime-local"){
      $output .= tbl($t, "<td class='setting-cell'>")."<input id=$id type=$type>".tbl($t, "</td>");
    }
    if ($type == "option"){
      $output .= tbl($t, "<td class='setting-cell'>")."<select name=$id>";
      for ($i=0; $i<count($data[0]); $i++){
        $output .= "<option value=".$data[0][$i];
        if ($default == $i){
          $output .= " selected";
        }
        $output .= ">".$data[1][$i]."</option>";
      }
      
      $output .= "</select>".tbl($t, "</td>");
    }
    $output .= tbl($t, "</tr>");
    return $output;
  }
?>