<script type="text/javascript">
$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        parseTime:false,

        data: [
        <?php 
        //TODO: Clean up
        $result = mysqli_query($db, "SELECT * FROM chart_info");
        $max_data = mysqli_num_rows($result);
        $i = 0;

        while($row = mysqli_fetch_array($result)) {
            $i = $i + 1;
            $y = $row['y'];
    
            echo "{";
            echo "period: 'Checkpoint $i',";
            echo "watertype: $y,";
            echo "}";

            if($i < $max_data)
                echo ",";
        }
        ?>
       ],
        xkey: 'period',
        ykeys: ['watertype'],
        labels: ['Water state'],
        pointSize: 2,
        hideHover: 'auto',
        lineColors: ['#ff0000'],
        resize: true
    });
    
});
</script>