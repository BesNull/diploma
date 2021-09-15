<h1></h1>
<table class="table table-light align-middle">
    <thead>
    <tr>
        <th scope="col">Почта</th>
        <th scope="col">ФИО</th>
        <th scope="col">Телефон</th>
        <th scope="col">Адрес</th>
    </tr>
    </thead>
    <tbody>
    <th scope="row">
       
        <input type="text" id="nMail" value="{$authUsr['mail']}">
        
    </th>
        <td><input type="text" id="nName" value="{$authUsr['fio']}" /></td>
        <td><input type="text" id="nTelephone" value="{$authUsr['telephone']}" /></td>
        <td><textarea id="nAdr">{$authUsr['adr']}</textarea>></td>
    </tbody>

</table>
        
<table class="table table-light align-middle">
    <thead>
    <tr>
        <th scope="col">Новый пароль</th>
        <th scope="col">Старый пароль</th>
        <th scope="col">Текущий пароль</th>
    </tr>
    </thead>
    <tbody>
        <td><input type="password" id="nPass1" value=""/></td>
        <td><input type="password" id = "nPass2" value=""></td>
        <td><input type="password" id = "crntPass" value=""></td>
    </tbody>
</table>
    <button onclick="updUsr();" class="btn btn-white btn-sm">Сохранить</button>
    
   
    <h4 class="text-white"> <br />Заказы</h4>
    
    {if !$dsUsrOrd}
        нет заказов
    {else}
        <table class="table table-light text-dark align-middle">
            <thead>
            <tr>
                <th scope="col">№</th>
                <th scope="col">Действие</th>
                <th scope="col">Айди</th>
                <th scope="col">Стат</th>
                <th scope="col">Дата создания</th>
                <th scope="col">Дата оплаты</th>
                <th scope="col">Доп. инфо</th>
            </tr>
            </thead>
            <tbody>
            {foreach $dsUsrOrd as $item name=ords}
            <tr>
                <th scope="row">{$smarty.foreach.ords.iteration}</th>
                <td><a class="btn btn-white btn-sm" style="height: 20%;" href="#" onclick="ProdsShow('{$item['id']}'); return false;">Показать товары в заказе</a></td>
                <td>{$item['id']}</td>
                <td>{$item['status']}</td>
                <td>{$item['date_created']}</td>
                <td>{$item['date_payment']}&nbsp;</td>
                <td>{$item['comment']}</td>
            </tr>
            
            <tr class="hideme" id="pursForOrdId_{$item['id']}">
                <td colspan="7">
                    {if $item['child']}
                        <table class="table table-dark">
                            <tr >
                                <th>№</th>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Цена</th>
                                <th>Кол-во</th>
                            </tr>
                            {foreach $item['child'] as $itemChild name=prods}
                                <tr>
                                    <td>{$smarty.foreach.prods.iteration}</td>
                                    <td>{$itemChild['product_id']}</td>
                                    <td><a href="/prod/{$itemChild['product_id']}">{$itemChild['name']}</td><!-- comment -->
                                    <td>{$itemChild['price']}</td>
                                    <td>{$itemChild['amount']}</td>
                                </tr>
                                {/foreach}
                        </table>
                        {/if}
                </td>
            </tr>
            {/foreach}
            </tbody>
        </table>
    {/if}

