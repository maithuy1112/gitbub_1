<?php
session_start();
if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url = $_SESSION["url"];
}

?>
<script>
    

    window.alert("<?php echo $_GET['message']; ?>");

    window.location.href = '<?php echo $url; ?>';
    
</script>