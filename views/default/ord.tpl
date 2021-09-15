<h3 class="text-white">Заказ</h3>

<form id="OrderForm" action="/basket/confirmord/" method="POST">
    <table class="table table-light align-middle">
        <tr class="table-dark">
            <td>№</td>
            <td>Наименование</td>
            <td>Кол-во</td>
            <td>Цена за ед.</td>
            <td>Цена общая</td>
        </tr>
        
        {foreach $dsProds as $item name=prods}
            <tr>
                <td>{$smarty.foreach.prods.iteration}</td>
                <td><a href="/prod/{$item['id']}/">{$item['name']}</a></td>
                <td>
                    <span id="itemcount_{$item['id']}">
                        <input type="hidden" name="itemcount_{$item['id']}" value="{$item['count']}"/>
                        {$item['count']}
                    </span>
                </td>
                
                <td>
                    <span id="itemprice_{$item['id']}">
                        <input type="hidden" name="itemprice_{$item['id']}" value="{$item['price']}" />
                        {$item['price']}
                    </span>
                </td>
                
                <td>
                    <span id="itemOverallprice_{$item['id']}">
                        <input type="hidden" name="itemOverallprice_{$item['id']}" value="{$item['overallPrice']}" />
                        {$item['overallPrice']}
                </td>
            </tr>
        {/foreach}
    </table>
        

    {if !isset($authUsr)}
        
        <div style="width:50%;" id="logB" class="col-md-6  col-xl-11 mb-3 ">
                <div class="card">
                    <div class="card-body">
                        
                            <h6 class="dark-grey-text text-center"><strong>Авторизация</strong></h6>
                        <hr>
                        
                         <div class="md-form">
                            <i class="fa fa-envelope prefix grey-text"></i>
                            <label for="logPass">Mail</label>
                            <input type="text" class="form-control" id="logMail" name="logMail" value=""/>
                            
                         </div><!-- comment -->
                         <hr>
                         
                        <div class="md-form">
                            <i class="fa fa-key prefix grey-text"></i>
                            <label for="logMail">Pass</label>
                            <input type="password" class="form-control" id="logPass" name="logPass"/>
                        </div>
                          <br />
                        <div class="text-center">
                            <input  class="btn btn-primary btn-sm" value="Войти" onclick="usrlogin();" /> 
                        </div>
                        
                    </div>
                </div>
    </div>
        
       <div id="regB">
                <div class="btn btn-primary btn-sm menuCapt showHidden" onclick="ShowReg();">Нет аккаунта?</div>
                <div id="RegHidden">
                <div class="input-group flex-nowrap">
                     <span class="input-group-text" id="addon-wrapping"><i class="fa fa-envelope prefix grey-text"></i></span>
                        <input type="text" id="mail" name="mail" class="form-control" placeholder="Mail" aria-label="Mail" aria-describedby="addon-wrapping" /> 

                </div>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa fa-key prefix grey-text"></i></span>
                    <input type="text" id="pass1" name="pass1" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="addon-wrapping" /> 
                </div>
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping"><i class="fa fa-key prefix grey-text"></i></span>
                    <input type="text" id="pass2" name="pass2" class="form-control" placeholder="Password Repeat" aria-label="Password Repeat" aria-describedby="addon-wrapping" /> 
                </div>
                    
                <input type="button" class="btn btn-primary btn-sm" value="Создать аккаунт" onclick="UserReg();" />

                        
                </div>
            </div>
        {$buttonClass = "class='btn btn-primary toast hide'"}
        {else}
            {$buttonClass=""}
    {/if}
    

    
    <div id="ordUsrInfo" {$buttonClass}>
        <h3 class="text-white">Данные</h3>
        {$fio = $authUsr['fio']}
        {$telephone = $authUsr['telephone']}
        {$adr = $authUsr['adr']}
        
        <table class="table table-light">
            <tr>
                <td class="table-dark">Имя</td>
                <td><input type="text" id="fio" name="fio" value="{$fio}" /></td>
            </tr>
            
              <tr>
                <td class="table-dark">Телефон</td>
                <td><input type="text" id="telephone" name="telephone" value="{$telephone}" /></td>
              </tr><!-- comment -->
              
            <tr>
                <td class="table-dark">Адрес</td>
                <td><textarea id="adr" name="adr" />{$adr}</textarea></td>
            </tr>
          
        </table>
    </div>
    <!-- в случае если человек не залогинин, то тогда этот батон класс будет равен hideme, т.е. кнопка не появится -->
   
    <input {if $buttonClass==""} class="btn btn-primary" {else} {$buttonClass} {/if} id="btnOrdSave" type="button" value="Заказать"  onclick="ordSave();" />
 
    
        
    </form>    
   
    