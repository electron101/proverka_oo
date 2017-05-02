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
    
    <h1 class="page-header"><i class="fa fa-plane"></i> Самолёты</h1>

	<a class="btn btn-md btn-primary btn_in_bottom" href="?act=samolet_add" role="button">
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Новый самолёт</a>  

<?php
	$result = $mysqli->query("SELECT * FROM samolet");
	if ($result):?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover " style=" font-size: 14px;" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Бортовой номер</th>
                            <th>Модель</th>
                            <th>Компания</th>
                            <th>Дата выпуска</th>
                            <th>Количество мест</th>
                            <th class="text-right">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form role="form" id="Form">
	<?php while ($row = $result->fetch_assoc()):?>
	 					<tr>
                            <td style=" vertical-align: middle; "><small class=""><?=$row["id"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["bort_num"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["model"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["company"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["date_vipusk"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["colvo_mest"]?></small>
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
            url: "scripts/samolet_del.php",
            type: "POST",
            data: str
        })
        .done(function(msg) 
        {
            // если сервер всё выполнил удачно то
            if(msg == "success")
            {
                window.location.href = "index.php?act=samolet";
            }
        })
    }
}
function edit(id)
{
    window.location.href = 'index.php?act=samolet_edit&id=' + id;
}
</script>
<?php require 'templates/footer.php'; ?>
