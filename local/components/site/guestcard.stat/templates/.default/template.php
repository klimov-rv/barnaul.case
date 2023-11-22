<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/**
* @var array $arResult
*/
?>

<div class="guestcard-stat">
    Карт создано: <?=$arResult["GUESTCARD_CNT"]?> <br>
    Карт активировано: <?=$arResult["GUESTCARD_ACTIVE_CNT"]?> <br>

    <table>
        <tr>
            <th>Пользователь</th>
            <th>Количество сканирований</th>
        </tr>
        <?foreach($arResult["USERS"] as $user):?>
            <tr>
                <td><?=$user["LOGIN"]?></td>
                <td><?=$user["UF_CHECKED_QR"]?></td>
            </tr>
        <?endforeach;?>
    </table>


</div>