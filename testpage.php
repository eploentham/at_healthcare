 <?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html>
    <script src="js/libs/jquery-2.1.1.min.js"></script>
<body>

<?php
// Set session variables
$_SESSION["favcolor"] = "green";
$_SESSION["favanimal"] = "cat";
echo "Session variables are set. ".$_SESSION["favanimal"];
?>
    <button type="button" id="btnGoodsAdd">
        aaaaa
    </button>
    <script type='text/javascript' charset="utf-8">
        $(document).ready(function(){
            //alert("favcolor ");
            $("#btnGoodsAdd").click(getV);
        });
        
        function getV(){
            var favcolor = '<?php echo $_SESSION["favcolor"]; ?>';
            //var favcolor="";
            alert("favcolor "+favcolor);
        }
    </script>
</body>
</html> 