<?php if (!preg_match('/(?i)msie [1-8]/', $_SERVER['HTTP_USER_AGENT'])) { ?>
  <?php use_javascript('flot/jquery.flot.js'); ?>
  <?php use_javascript('flot/jquery.flot.pie.js'); ?>
<?php } ?>

<?php $badge = $party->getOrientationBadge() ?>
<?php $graphData = $party->getOrintationGraphData() ?>

<?php if (count($graphData) > 0) { ?>
  <script>

    var data = [
  <?php
  $i = 0;
  foreach ($graphData as $val) {
    $i++;
    ?>
      { label: "<?php echo $val['name'] ?>", data: <?php echo $val['percent'] ?>}<?php
    if ($i != count($graphData)) {
      echo ",";
    }
    ?>
  <?php } ?>
    ];</script>
<?php } ?>


<div class="orientationTitle">
  <div class="subtitle"><?php echo __('Orientation') ?></div>
  <h2><?php echo $badge->getName() ?></h2>
</div>
<div class="badge">
  <div class="badge-universal" style="background-image: url('<?php echo $badge->getImageUrl() ?>');">&nbsp;</div>
</div>
<div class="clear"></div>
<div class="orientationContent"><?php echo $badge->getDescription() ?></div>

<?php if (count($graphData) > 0) { ?>
  <div class="chart" id="default1" style="height: 250px;">

  </div>
  <?php if (!preg_match('/(?i)msie [1-8]/', $_SERVER['HTTP_USER_AGENT'])) { ?>
    <script type="text/javascript">
              $(function() {

        $.plot($("#default1"), data,
                {
                  series: {
                    pie: {
                      show: true,
                      label: {
                        show: true,
                        radius: 1,
                        formatter: function(label, series) {
                          return '<div style="font-size:8pt;text-align:center;padding:2px;color:white;">' + label + '<br/>' + Math.round(series.percent) + '%</div>';
                        },
                        background: {
                          opacity: 0.8,
                          color: '#000'
                        }
                      }
                    }
                  },
                  legend: {
                    show: false
                  }
                });
      });


      function pieHover(event, pos, obj)
      {
        if (!obj)
          return;
        percent = parseFloat(obj.series.percent).toFixed(2);
        $("#hover").html('<span style="font-weight: bold; color: ' + obj.series.color + '">' + obj.series.label + ' (' + percent + '%)</span>');
      }

      function pieClick(event, pos, obj)
      {
        if (!obj)
          return;
        percent = parseFloat(obj.series.percent).toFixed(2);
        alert('' + obj.series.label + ': ' + percent + '%');
      }
    </script>
  <?php } ?>

<?php } ?>