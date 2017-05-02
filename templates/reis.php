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
    
    <h1 class="page-header"><i class="fa fa-list"></i> Рейсы</h1>

	<a class="btn btn-md btn-primary btn_in_bottom" href="?act=reis_add" role="button">
		<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Новый рейс</a>  

<?php
	$result = $mysqli->query("SELECT reis.id_reis, reis.date_time_vilet, 
							reis.date_time_posadka, g1.name AS gorod_vilet, 
							g2.name AS gorod_posadka, samolet.bort_num, reis.colvo_mest 
							FROM reis JOIN gorod AS g1 ON reis.id_gorod_vilet = g1.id 
							JOIN gorod as g2 ON reis.id_gorod_posadka = g2.id 
							JOIN samolet ON reis.id_samolet = samolet.id ORDER BY reis.id_reis DESC");
	if ($result):?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover " style=" font-size: 14px;" >
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Дата вылета</th>
                            <th>Дата посадки</th>
                            <th>Откуда</th>
                            <th>Куда</th>
                            <th>Бортовой номер</th>
                            <th>Количество мест</th>
                            <th class="text-right">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        <form role="form" id="Form">
	<?php while ($row = $result->fetch_assoc()):?>
	 					<tr>
                            <td style=" vertical-align: middle; "><small class=""><?=$row["id_reis"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["date_time_vilet"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["date_time_posadka"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["gorod_vilet"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["gorod_posadka"]?></small>
                            </td>

                            <td style=" vertical-align: middle; "><small class=""><?=$row["bort_num"]?></small>
                            </td>
                            <td style=" vertical-align: middle; "><small class=""><?=$row["colvo_mest"]?></small>
							</td>

                            <td class="text-right">
                                <div class="btn-group btn-group-xs ">

                                    <button data-original-title="Редактировать" id="sort_list" value="main" type="button" class="btn btn-primary " data-toggle="tooltip" data-placement="bottom" title="" onclick="return edit('<?=$row["id_reis"]?>')"><i class="fa fa-edit"></i> </button>

                                    <button data-original-title="Удалить" id="sort_list" value="free" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="" onclick="return del('<?=$row["id_reis"]?>')"><i class="fa fa-trash"></i> </button>

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
            url: "scripts/reis_del.php",
            type: "POST",
            data: str
        })
        .done(function(msg) 
        {
            // если сервер всё выполнил удачно то
            if(msg == "success")
            {
                window.location.href = "index.php?act=reis";
            }
        })
    }
}
function edit(id)
{
    window.location.href = 'index.php?act=reis_edit&id_reis=' + id;
}
</script>
<?php require 'templates/footer.php'; ?>