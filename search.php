<?php 
session_start();
require_once 'php/consultas.php';
require_once 'php/cn.php';
$bd = cn();

$tableName="encuesta";   
$targetpage = "search.php";  
$limit = 5;
$searchtext = $_GET['q'];
$query = "SELECT COUNT(*) as num FROM $tableName WHERE descripcion LIKE '%$searchtext%' and public = 1 ORDER BY created_at";
$total_pages = mysqli_fetch_array(mysqli_query($bd,$query));
$total_pages = $total_pages['num'];

$stages = 3;
$page = mysqli_escape_string($bd,$_GET['page']);


if($page){
    $start = ($page - 1) * $limit; 
}else{
    $start = 0; 
}   

// Get page data
$query1 = "SELECT * FROM $tableName  WHERE descripcion LIKE '%$searchtext%' and public = 1 ORDER BY created_at LIMIT $start, $limit";
$result = mysqli_query($bd,$query1);

// Initial page num setup
if ($page == 0){$page = 1;}
$prev = $page - 1;  
$Siguiente = $page + 1;  
$lastpage = ceil($total_pages/$limit);  
$LastPagem1 = $lastpage - 1;    
$paginate = '';
if($lastpage > 1){       
    $paginate .= "<div class='paginate'>";
    // Anterior
    if ($page > 1){
        $paginate.= "<a href='$targetpage?q=$searchtext&page=$prev'>Anterior</a>";
    }else{
        $paginate.= "<span class='disabled'>Anterior</span>";   }
        // Pages    
        if ($lastpage < 7 + ($stages * 2)){   
            for ($counter = 1; $counter <= $lastpage; $counter++){
                if ($counter == $page){
                    $paginate.= "<span class='current'>$counter</span>";
                }else{
                    $paginate.= "<a href='$targetpage?q=$searchtext&page=$counter'>$counter</a>";}    
                }
            }
            elseif($lastpage > 5 + ($stages * 2))   // Enough pages to hide a few?
            {
                // Beginning only hide later pages
                if($page < 1 + ($stages * 2))   
                {
                    for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
                    {
                        if ($counter == $page){
                            $paginate.= "<span class='current'>$counter</span>";
                        }else{
                            $paginate.= "<a href='$targetpage?q=$searchtext&page=$counter'>$counter</a>";}    
                    }
                    $paginate.= "...";
                    $paginate.= "<a href='$targetpage?q=$searchtext&page=$LastPagem1'>$LastPagem1</a>";
                    $paginate.= "<a href='$targetpage?q=$searchtext&page=$lastpage'>$lastpage</a>";
                }
                // Middle hide some front and some back
                elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
                {
                    $paginate.= "<a href='$targetpage?q=$searchtext&page=1'>1</a>";
                    $paginate.= "<a href='$targetpage?q=$searchtext&page=2'>2</a>";
                    $paginate.= "...";
                    for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
                    {
                        if ($counter == $page){
                            $paginate.= "<span class='current'>$counter</span>";
                        }else{
                            $paginate.= "<a href='$targetpage?q=$searchtext&page=$counter'>$counter</a>";}    
                    }
                    $paginate.= "...";
                    $paginate.= "<a href='$targetpage?q=$searchtext&page=$LastPagem1'>$LastPagem1</a>";
                    $paginate.= "<a href='$targetpage?q=$searchtext&page=$lastpage'>$lastpage</a>";
                }
                // End only hide early pages
                else
                {
                    $paginate.= "<a href='$targetpage?q=$searchtext&page=1'>1</a>";
                    $paginate.= "<a href='$targetpage?q=$searchtext&page=2'>2</a>";
                    $paginate.= "...";
                    for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
                    {
                        if ($counter == $page){
                            $paginate.= "<span class='current'>$counter</span>";
                        }else{
                            $paginate.= "<a href='$targetpage?q=$searchtext&page=$counter'>$counter</a>";}
                    }
                }       
            }       
                    // Siguiente
            if ($page < $counter - 1){ 
                $paginate.= "<a href='$targetpage?q=$searchtext&page=$Siguiente'>Siguiente</a>";
            }else{
                $paginate.= "<span class='disabled'>Siguiente</span>";
                }
            $paginate.= "</div>";   
    }
$bd->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>MooTics - Search</title>
	<?php include 'includes/head.php'; ?>
</head>
<body>
<?php include 'includes/navbar.php'; ?>
<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-md-8 bg-white p-3 shadow-sm border rounded">
        <?php 
        echo "<h4 class='float-left'>Busqueda: $searchtext </h4>";
        echo "<h4 class='float-right'>Resultados: $total_pages </h4>
        <br><hr>";
        if(mysqli_num_rows($result) > 0){
            echo "<center class='mb-3'>".$paginate."</center>";
            while($row = mysqli_fetch_array($result)){
                echo "
                        <div class='encuesta border rounded bg-white d-flex justify-content-between mb-3'>
                            <p class='font-weight-bold p-3 m-0 text-truncate'>$row[1]</p>
                            <div class='e-buttons d-flex'>
                                <a href='./?e=$row[0]' class='btn btn-primary rounded-0 d-flex align-items-center'>
                                    <i class='fas fa-external-link-alt text-white'></i>
                                </a>
                            </div>
                        </div>";
            }
        }else{
            echo "<h3>No se encontraron resultados</h3>";
        } 
        
        
        ?>
        
        </div>
        
        <div class="col"></div>
    </div>
</div>
<?php include 'includes/message-box.php' ?>
<?php include 'includes/footer.php'; ?>


    <!-- Boostrap JS -->
<?php include 'includes/main-scripts.php'; ?>
</body>
</html>