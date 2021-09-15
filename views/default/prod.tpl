

 <div style="float: left; padding: 30px 30px 40px 350px; width: 150% ">
       <div
            class="bg-image card shadow-1-strong  text-center"
            style="background-image: url('https://image.freepik.com/free-vector/abstract-minimal-white-background_23-2148887988.jpg');  "
          >
            <div class="card-body text-dark">
                <h5 class="card-title">{$dsProd.name}</h5>
                <hr>
                <p class="card-text">

                    <img
                      class="img-fluid rounded shadow-2-strong hover-shadow-soft"
                      src="/img/prods/{$dsProd.pic}"


                      style="height: 270px; width: 190px;"


                    />
        
                 <br />
                </p>
                
                <p class="card-text">
                     <h5 class="card-title">Описание</h5> <hr>
                     {$dsProd.descr}
                </p>
                    <hr>
            </div>
            <a id="remBasket_{$dsProd.id}" {if ! $checkProdInBasket}class="hideme"{/if} href="#" onClick="remFromBasket({$dsProd.id}); return false;" alt="Встать на правильный путь и вернуть товар"><button class="btn btn-outline-light text-black" style="width: 100%;">Удалить</button> </a>
            <a id="addBasket_{$dsProd.id}" {if  $checkProdInBasket}class="hideme"{/if} href="#" onClick="addToBasket({$dsProd.id}); return false;" alt="Добавить в сумку и убежать"><button class="btn btn-outline-light text-black" style="width: 100%;">Добавить </button></a>
        </div>
                      
</div>
<!--
<img width="575" src="/img/prods/{$dsProd.pic}">
<br />
Костян: {$dsProd.price}
<br />
-->
<!--возвращаем false для того, чтобы страничка не прыгала вверх
href="#" чтобы ссылка никуда не вела
-->






