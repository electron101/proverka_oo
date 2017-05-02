<?php 
include 'function/whoami.php';
if (!IS_ADMIN)
{
    header('Location: ?act=main');
    exit();
}
require 'templates/header_admin.php';

include('../connect_bd.php');
include 'function/date_format.php';
?>

<style>
body {
      padding-top: 45px;
    }

	.btn_in_bottom {
		margin-bottom: 25px;
	}
</style>
    
    <h1 class="page-header"><i class="fa fa-ruble"></i> Стоимость билетов</h1>

	<a class="btn btn-md btn-primary btn_in_bottom" href="?act=stoimost_add" role="button">
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Новая стоимость</a>  

<?php
	$result = $mysqli->query("SELECT stoimost.id, stoimost.id_reis, class.name, stoimost.sum 
								FROM stoimost JOIN class ON stoimost.id_class = class.id");
	if ($result):?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover " style=" font-size: 14px;" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th># Рейса</th>
                            <th>Класс</th>
                            <th>Стоимость (руб)</th>
                            <th class="text-right">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form role="form" id="Form">
	<?php while ($row = $result->fetch_assoc()):?>
	 					<tr>
                            <td style=" vertical-align: middle; "><small class=""><?=$row["id"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["id_reis"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["name"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["sum"]?></small>
                            </td>

                            <td class="text-right">
                                <div class="btn-group btn-group-xs ">

                                    <button data-original-title="Редактировать" id="sort_list" value="main" type="button" class="btn btn-primary " data-toggle="tooltip" data-placement="bottom" title="" onclick="return edit('<?=$row["id"]?>')"><i class="fa fa-edit"></i> </button>

                                    <button data-original-title="Удалить" id="sort_list" value="free" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" onclick="return del('<?=$row["id"]?>')"><i class="fa fa-trash"></i> </button>

                                </div>
                            </td>
                            
                        </tr>
    <?php endwhile;?>
                        </form>
    				</tbody>
                </table>
            </div>

	<?php endif;

    $result->free();
	$mysqli->close();
?>		
<script>
function del(id)
{
    if(confirm('Удалить запись?'))
    {
        var str = "del_id=" + id;

        $.ajax(
        {
            url: "scripts/stoimost_del.php",
            type: "POST",
            data: str
        })
        .done(function(msg) 
        {
            // если сервер всё выполнил удачно то
            if(msg == "success")
            {
                window.location.href = "index.php?act=stoimost";
            }
        })
    }
}
function edit(id)
{
    window.location.href = 'index.php?act=stoimost_edit&id=' + id;
}
</script>
<?php require 'templates/footer.php'; ?>
