
{if ! $dsProds}
     <h2 class="text-white">Пусто</h2>
{else}
    <form action="/basket/ord/" method="POST">    <!--controller=basket, action=ord -->
       
    <table class="table table-light align-middle text-center">
        <thead class="table-dark">
        <tr>
            <td>
                №
            </td>
            
            <td>
                Название
            </td>
            
            <td>
                Кол-во
            </td>
            
            <td>
                Цена
            </td>
            
            <td>
                Общая цена
            </td><!-- comment -->
            
            <td>
                b or not to be
            </td>
        </tr>
        </thead>
        
        {foreach  $dsProds as $item name=prods}
        <tr>
            <td>
                {$smarty.foreach.prods.iteration}
            </td>
            
            <td>
                <a href="/prod/{$item.id}/">{$item.name}</a><br />
            </td>
            
            <td>
                <input class="text-center" name="itemcount_{$item.id}" id="itemcount_{$item.id}" type="number" value="1" style="width: 30%;" onchange="PriceConvert({$item.id});"/>
            </td>
            
            <td>
                <span id="Price_{$item.id}" value="{$item.price}">  <!-- у span нет аттрибута value, здесь мы его придумали -->
                    {$item.price}
                </span>
            </td>
            
            <td>
                <span id="OverallPrice_{$item.id}">
                    {$item.price}
                </span>
            </td>
            
            <td>
                <a id="remBasket_{$item.id}"  href="#" onClick="remFromBasket({$item.id}); return false;" alt="Встать на правильный путь и вернуть товар">
                    <button type="button" class="btn btn-danger btn-sm px-3">
                    <i class="fas fa-times"></i>
                    </button>                   
                </a>
                <a id="addBasket_{$item.id}" class="hideme" href="#" onClick="addToBasket({$item.id}); return false;" alt="Добавить в сумку и убежать">
                    <button type="button" class="btn btn-success btn-sm px-3">
                    <i class="fas fa-undo"></i>
                    </button>   
                </a>
            </td>
        </tr>
        {/foreach}
    </table>
        <input class="btn btn-light btn-sm" type="submit" value="Подтвердить заказ"/>
    </form>
{/if}


