<?php
    require_once('./require/header.php');
    
// Connect to MySQL database
$pdo = pdo_connect_mysql();

// Get the total number of records from our table "students".
$total_pages = $con->query('SELECT COUNT(*) FROM clients')->fetch_row()[0];

// Check if the page number is specified and check if it's a number, if not return the default page number which is 1.
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Number of results to show on each page.
$records_per_page = 8;


if ($stmt = $con->prepare('SELECT * FROM clients ORDER BY name LIMIT ?,?')) {
	// Calculate the page to get the results we need from our table.
	$calc_page = ($page - 1) * $records_per_page;
	$stmt->bind_param('ii', $calc_page, $records_per_page);
	$stmt->execute(); 
	// Get the results...
	$result = $stmt->get_result();
	$stmt->close();
}


?>

<?=template_header('Clients')?>

<div class="content read">
	<h1>CLIENTS</h1>
	<a href="./createclient.php" class="create-contact">Create Client</a>
    <div class="w3-right w3-padding">      
        <input id="tableSrch" type="text" placeholder="Filter..">
    </div> 
	<table class="w3-table w3-hoverable" id="srtTable">
        <thead>
            <tr>
                <th>Name</th>
                <th><a href="javascript:SortTable(1,'D','ymd');">Birth Date <i class="fa fa-sort"></a></th>
                <th>Primary Phone</th>
                <th>Policy</th>
                <th><a href="javascript:SortTable(4,'T');">Insurer <i class="fa fa-sort"></a></th>
                <th>App Status</th>
                <th><a href="javascript:SortTable(6,'D','ymd h:m:s');">Created <i class="fa fa-sort"></a></th>
                <th></th>
            </tr>
        </thead>
        <tbody id="tblSrch">
            <?php while ($row = $result->FETCH_ASSOC()): ?>
            <tr>
                <td><a href="./view.php?id=<?=$row['id']; ?>" target="_blank"><?=$row['name']?></a></td>
                <td><?=$row['birthdate']?></td>
                <td><?=$row['phone']?></td>
                <td><?=$row['policy']?></td>
                <td><?=$row['insurer']?></td>
                <td><?=$row['appstatus']?></td>
                <td><?=$row['created']?></td>
                <td class="actions">       
                    <a href="add-task.php?name=<?=$row['name']?>&&type=<?="Client";?>" class="task"><i class="fas fa-tasks fa-xs"></i></a>
                    <a href="viewCls.php?id=<?=$row['id']?>" class="view" target="_blank"><i class="fas fa-eye fa-xs"></i></a>
                    <a href="updateclient.php?id=<?=$row['id']?>" class="edit"><i class="fas fa-edit fa-xs"></i></a>                    
                    <a href="delete.php?name=<?=$row['name']?>" class="trash"><i class="fas fa-trash-alt fa-xs"></i></a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php if (ceil($total_pages / $records_per_page) > 0): ?>
        <ul class="pagination">
            <?php if ($page > 1): ?>
            <li class="prev"><a href="clients.php?page=<?php echo $page-1 ?>">Prev</a></li>
            <?php endif; ?>

            <?php if ($page > 3): ?>
            <li class="start"><a href="clients.php?page=1">1</a></li>
            <li class="dots">...</li>
            <?php endif; ?>

            <?php if ($page-2 > 0): ?><li class="page"><a href="clients.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a></li><?php endif; ?>
            <?php if ($page-1 > 0): ?><li class="page"><a href="clients.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a></li><?php endif; ?>

            <li class="currentpage"><a href="clients.php?page=<?php echo $page ?>"><?php echo $page ?></a></li>

            <?php if ($page+1 < ceil($total_pages / $records_per_page)+1): ?><li class="page"><a href="clients.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a></li><?php endif; ?>
            <?php if ($page+2 < ceil($total_pages / $records_per_page)+1): ?><li class="page"><a href="clients.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a></li><?php endif; ?>

            <?php if ($page < ceil($total_pages / $records_per_page)-2): ?>
            <li class="dots">...</li>
            <li class="end"><a href="clients.php?page=<?php echo ceil($total_pages / $records_per_page) ?>"><?php echo ceil($total_pages / $records_per_page) ?></a></li>
            <?php endif; ?>

            <?php if ($page < ceil($total_pages / $records_per_page)): ?>
            <li class="next"><a href="clients.php?page=<?php echo $page+1 ?>">Next</a></li>
            <?php endif; ?>
        </ul>
    <?php endif; ?>

</div>

<?php require_once('./require/footer.php');?>
