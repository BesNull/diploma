<h3 class="text-white">{$dsCat.name}</h3>

   {foreach $dsProd as $item name=prods}
    <div style="float: left; padding: 130px 30px 40px 0px;">
       <div
  class="bg-image card shadow-1-strong  text-center"
  style="background-image: url('https://image.freepik.com/free-vector/abstract-minimal-white-background_23-2148887988.jpg');  "
>
  <div class="card-body text-dark">
    <h5 class="card-title">{$item.name}</h5>
    <hr>
    <p class="card-text">
        <a class="ripple" href="/prod/{$item.id}/" >
            <img
              class="img-fluid rounded shadow-2-strong hover-shadow-soft"
              src="/img/prods/{$item.pic}"
              
              
              style="height: 270px; width: 190px;"
             
             
            />
        </a>
     <br />
    </p>
    <a href="/prod/{$item.id}/" class="btn btn-outline-danger">Купить</a>
  </div>
  
</div>
  </div>
<!-- дальше если че чтоб в несколько рядов было -->
    {if $item@iteration mod 6 == 0}
        <div style="clear: both;"></div>
    {/if}
{/foreach}
    

<!-- Это короче робит, когда жмем праворй кнопкой по телеофнам или планшетам вылазят подкатегории -->
    {foreach $dsCatChild as $item name=childcat}
        <h2><a href = "/cat/{$item.id}/">{$item.name}</a></h2>
        {/foreach}
                