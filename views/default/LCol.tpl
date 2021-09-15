<!--class="bg-image p-5 text-center shadow-1-strong rounded mb-5 text-black"  вот этот класс выровнял ваще всё в левой колонке  -->
<div class="bg-image p-1 text-center shadow-1-strong rounded mb-5 text-black" style="background-image: url(https://aduvan.ru/wp-content/uploads/photo-gallery/imported_from_media_libray/4_1-scaled.jpg?bwg=1601621541); height: 87.5%;"  id = "LCol">
        <!--
        <div id="Lmenu">
            <div class="menuCapt"> Menu:</div>
         
            </div>
        -->
            <!--   <i class="fa fa-user prefix grey-text"></i>  иконка для ауфа--> 
            <!--   Можно сделать батон, а в нем ссылку <a></a>--> 
            <br />
            {if isset($authUsr)}
               
                <div id="usrB">
                    Аккаунт
                <div id="usrBicon" class="nav-item dropdown">
        <a
          class="nav-link dropdown-toggle d-flex align-items-center "
          href="#"
          id="navbarDropdownMenuLink"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
            class="rounded-circle"
            height="22"
            alt=""
            loading="lazy"
          />
          
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li>
            <a class="dropdown-item" href="/u/" id="usrL">{$authUsr['showName']}</a>
          </li>
          <li>
            <a class="dropdown-item" href ="/u/usrlogout/" onclick="usrlogout();">Выход</a>
          </li>
        </ul>
          </div>
          </div>
         
         
            <!-- Там видос 4.7, там комменты, там вроде есть метод упрощения всей этой дичи -->

            {else}
       
           
            <div id="usrB" class="hideme">
                Аккаунт
                <div id="usrBicon" class="nav-item dropdown">
                 <a
          class="nav-link dropdown-toggle d-flex align-items-center"
          href="#"
          id="navbarDropdownMenuLink"
          role="button"
          data-mdb-toggle="dropdown"
          aria-expanded="false"
        >
          <img
            src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg"
            class="rounded-circle"
            height="22"
            alt=""
            loading="lazy"
          />
          
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <li>
            <a class="dropdown-item" href="#" id="usrL"></a>
          </li>
          <li>
            <a class="dropdown-item" href ="/u/usrlogout/" onclick="usrlogout();">Выход</a>
          </li>
        </ul>
               </div>
        </div>
            
                
                
                
                
            {if ! isset($HideRegAuth)}    
            <div id="logB" class="col-md-6  col-xl-11 mb-3 ms-2">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <h6 class="dark-grey-text text-center"><strong>Авторизация</strong></h6>
                        
                        <hr>
                        
                         <div class="md-form">
                            <i class="fa fa-envelope prefix grey-text"></i>
                            <label for="logPass">Mail</label>
                            <input type="text" class="form-control" id="logMail" name="logMail" value="">
                            
                         </div><!-- comment -->
                         <hr>
                         
                        <div class="md-form">
                            <i class="fa fa-key prefix grey-text"></i>
                            <label for="logMail">Pass</label>
                            <input type="password" class="form-control" id="logPass" name="logPass">
                        </div>
                          <br />
                        <div class="text-center">
                            <input  class="btn btn-primary btn-sm" value="Войти" onclick="usrlogin();" >

                        </div>
            
                        </form>
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
                    
                <input type="button" class="btn btn-primary btn-sm" value="Создать аккаунт" onclick="UserReg();" >

                        
                </div>
            </div>
            
            
                
<!--
            <div id="logB">
                <div class="menuCapt">Авторизация</div>
                Логин <br />
                <input type="text" id="logMail" name="logMail" value=""/><br />
                Пароль
                <input type="password" id="logPass" name="logPass" value=""/><br />
                <input type="button" onclick="usrlogin();" value="Залететь"/>
            </div>
-->
            
               <!--
            <div id="regB">
                <div class="menuCapt showHidden" onclick="ShowReg();">Ебистрабция</div>
                <div id="RegHidden">
                    Mail:<br />
                    <input type="text" id="mail" name="mail" value=""/><br />
                    Pass:<br />
                    <input type="password" id="pass1" name="pass1" value=""/><br />
                    PassRepeat: <br />
                    <input type="password" id="pass2" name="pass2" value=""/><br />
                    
                    <input type="button" onclick="UserReg();" value="Реганутсья"/><br />
                </div>
            </div>
               -->
            {/if}
        {/if}
            
        <br /> 
        
        <!-- тут при добавлении id в span перестает нормально работать счетчик корзины -->
            <a href="/basket/" title="Залететь с ноги в киоск">
            <div class="menuCapt">
                <span ><i class="fas fa-shopping-cart me-3"></i></span><br/>В корзине&nbsp
                <span class="badge badge-pill bg-danger" id="basketcountitems">
                {if $basketcountitems > 0}{$basketcountitems}{else}0{/if}
            </span>
            </div>
            </a>
            
    </div>
