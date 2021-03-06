<?php
  global $civicrm_id;
  include $_SERVER['DOCUMENT_ROOT'].'/login.php';
  include $_SERVER['DOCUMENT_ROOT'].'/insights/dbcalls.php';
  date_default_timezone_set('America/Toronto');

  $title = "Discover Contacts - Threshold Summary";
  $thisFile = "/insights/discover/threshold/";
  $activeInsights = "active";
  $crumbs = array("Home" => "/", "Insights" => "/insights/", $title => $thisFile);

  $dcThresholdActive = "active";
  $tableConfig = "'aaSorting': [],\n";
  $tableSorting = "'aoColumnDefs': [{'asSorting':['desc','asc'], 'aTargets': [ 0, 1 ] }],\n";
  include $_SERVER['DOCUMENT_ROOT'].'/header.php';
  include $_SERVER['DOCUMENT_ROOT'].'/insights/header_insights.php';
?>

    <div class="col-md-9" >
      <table id="datatable" cellpadding="0" cellspacing="0" border="0" class="datatable table table-striped table-bordered">
        <thead>
          <tr>
            <th>Threshold</th>
            <th>Number of Contacts</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $thresholds = getDCThresholds($_POST);

            $total = 0;
            foreach($thresholds as $key => $value){
              $total += intval($value);
            }

            $thresholdLabels = array(0 => "Unknown", 1 => "Know and trust a Christian", 2 => "Become curious", 
              3 => "Become open to change", 4 => "Seek God", 5 => "Make a decision", 6 => "Grow in relationship with God");
            foreach($thresholdLabels as $id => $label){
              echo "<tr><td>" . $label . "</td>";
              echo "<td>" . ($thresholds[$id] ?: 0) . "</td></tr>";
            }
          ?>
        </tbody>
        <tfoot>
          <tr>
            <?php
              echo "<th>Total</th>";
              echo "<th>" . $total . "</th>";
            ?>
          </tr>
        </tfoot>
      </table>

      <div class="well well-sm">
        <h3>Help</h3>
        <p><strong>Report Time Frame:</strong></p>
        <p>This report contains contacts that were active during the time frame provided in the menu (default is this school year).</p>
      </div>
    </div>
  <?php include $_SERVER['DOCUMENT_ROOT'].'/footer.php'; ?>

  </body>
</html>
