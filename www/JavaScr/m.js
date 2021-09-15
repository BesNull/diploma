// # значит id в .tpl
//
function addToBasket(itemid){
    console.log("js - addToBasket()"); //тупо для отлдаки, чтобы в браузере в консоли вывелся текст, какая функция отработала
    $.ajax({
        method: 'POST',  //или type
        //async: false,
        url: "/basket/addtobasket/" + itemid + '/',
        dataType: 'json', //мэйби убрать
        success: function(data) {    //data - то, что нам отправил BasketController jsonencode resultdata, success походу служебное слово у json файлоа или вроде того, надо чекать
            if (data['success']){
                $('#basketcountitems').html(data['countitems']); //изменяем на кол-во текущих элементов в корзине
                console.log(data);  //если эта штука не отображется в консоли браузера, значит data нормально к нам не пришла
                
                $('#addBasket_' + itemid).hide();
   
                $('#remBasket_' + itemid).show();
                
                
            }
        },
          error: function (request, status, error) {
           // alert(request.responseText);
            //alert(error.responseText);
        }
    });
}

function remFromBasket(itemid){
    console.log("js - remfromBasket("+itemid+")");
     $.ajax({
        method: 'POST',  //или type
        //async: false,
        url: "/basket/remfrombasket/" + itemid + '/',  //данный url преобразуется htaccess в тип controoller=? action=? id=? чтобы сделать то, что нужно, он там попадает в BasketController, попадает в remfrombasketAction и все ок
        dataType: 'json', //мэйби убрать
        success: function(data) {    
            if (data['success']){
                $('#basketcountitems').html(data['countitems']); 
                
                $('#addBasket_' + itemid).show();
   
                $('#remBasket_' + itemid).hide();
            }
        }
          
    });
}

function PriceConvert(itemid){
    var newcount = $('#itemcount_' + itemid).val();
    var Price = $('#Price_' + itemid).attr('value');
    var OverallPrice = newcount * Price;
    
    $('#OverallPrice_' + itemid).html(OverallPrice);            
}


function getDat(obj_form){
    var bDat = {};
    $('input, textarea, select', obj_form).each(function(){   //пробегаем по всем инпутам и прочим полям
        if(this.name && this.name!=''){
            bDat[this.name] = this.value;
            console.log('bDat[' + this.name + '] = ' + bDat[this.name]); //для наглядности в консоль сделаем вывод
        }
    });
       return bDat;     
};

function UserReg(){  
    var postData = getDat('#regB');
     var pathname = window.location.pathname; 
    $.ajax({
        type: 'POST',
        async: true,
        url: "/u/reg/",  //  /u/ должно совпадать с Ucontroller,reg с regAction в нем , все преобразования в mFucntions в 4 строке
        //эта ссылка преобразуется в htacess и начинает все работать
        data: postData, //данные для POST и эти данные ловятся $_REQUEST в Ucontroller
        dataType: 'json',
        success: function(data){ //data из Ucontroller
            if(data['success']){
                alert('Успешная регистрация');  //можно data['mesg'] вывести
                
                //> блок в левом столбце
                $('#regB').hide();
                
                $('#usrL').attr('href', '/u/'); //так можно изменять любой аттрибут
                $('#usrL').html(data['nickName']);
                $('#usrB').show();
                
                //страница заказа
                $('#logB').hide();
                $('#btnOrdSave').show();
                
                  document.getElementById("btnOrdSave").className="btn btn-primary";
                  document.getElementById("ordUsrInfo").className="";
                 /*  
                   if (pathname==='/basket/ord/')
                   {
                   document.location='/basket/';
                    }
                */
                
                
            }
            else {
                alert(data['mesg']);
            }
                
        }
        
    });
    }
    
    
    function usrlogin(){
        var mail = $('#logMail').val();
        var pass = $('#logPass').val();
        var pathname = window.location.pathname; 
        
        var postData = "mail=" + mail +"&pass=" + pass;
        console.log(postData);
        $.ajax({
            type: 'POST',
            async: true,
            url: "/u/usrlogin/",
            data: postData,
            dataType: 'json',
            success: function(data){
                console.log(data);
                if (data['success']){
                    $('#regB').hide();
                    $('#logB').hide();
                    
                    $('#usrL').attr('href', '/u/');
                    $('#usrL').html(data['showName']);
                    $('#usrB').show();
                    
                    // заполняем поля на странице заказа
                    $('#fio').val(data['fio']);
                    $('#telephone').val(data['telephone']);
                    $('#adr').val(data['adr']);
                    
                    $('#btnOrdSave').show();
                    document.getElementById("btnOrdSave").className="btn btn-primary";
                    document.getElementById("ordUsrInfo").className="";
                    
                    /*
                    //тут мы именно поля в tpl шаблоне заполняем для того, чтобы с них могла взять инфа дял сохранения заказа. А сверху тупо хз чо, ибо в шаблоне эти переменные из $authUsr ваще грузяться
                    $('#fio').attr('value', data['fio']);
                    $('#telephone').attr('value', data['telephone']);
                    $('#adr').attr('value', data['adr']);
                    */
                    
                    
                    
                   // document.getElementById("ordUsrInfo").className="";
                   /*
                   if (pathname==='/basket/ord/')
                   {
                   document.location='/basket/';
                   }
                    */
                    

                    
                }
                else{
                    alert(data['mesg']);
                }
            }
        });
    }

    
    //корочи в 4.7 есть в комментах фишка, как сделать это без этой функции
function ShowReg(){
    if ($("#RegHidden").css('display') != 'block'){
        $("#RegHidden").show();
    }
    else{
        $("#RegHidden").hide();
    } 
}

//4.10 на 13:10 пояснения про улучшение работы данной фиговины, там типа если table взять в <div> и дать ему id
function updUsr(){
    console.log("js - updUsrData()");
    var telephone = $('#nTelephone').val();
    var adr = $('#nAdr').val();
    var pass1 = $('#nPass1').val();
    var pass2 = $('#nPass2').val();
    var crntPass = $('#crntPass').val();
    var fio = $('#nName').val();
    
    var postData = {
        telephone: telephone,
        adr: adr,
        pass1: pass1,
        pass2: pass2,
        crntPass: crntPass,
        fio: fio
    };
    
    $.ajax({
        type: 'POST',
        async: true,
        url: "/u/upd/",
        data: postData,
        dataType: 'json',
        success: function(data){
            if(data['success']){
                $('#usrL').html(data['nickName']);
                alert(data['mesg']);
            }
            else{
                alert(data['mesg']);
            }
        }
    });
    
}


function ordSave(){
    var postData = getDat('#OrderForm');  //<form></form> вот эту штуку передали, можно просто ('form')
    console.log(postData);
    $.ajax({
       method: 'POST',
       async: true,
       url: "/basket/confirmord/",
       data: postData,
       dataType: 'json',
       success: function(data){
           if(data['success']){
               alert(data['mesg']);
               document.location = '/';
           }
           else {
               alert(data['mesg']);
           }
       }  
    });
}

function ProdsShow(id){
    var objName = "#pursForOrdId_" + id;
    if ($(objName).css('display') != 'table-row') {
        $(objName).show();
    }
    else{
        $(objName).hide();  
    }
}







//to-do list eptu 
/*
 * 1) Функция usrlogout() в Lcol.tpl не реализолвана НО! usrlogoutAction есть и он работает
 *      1.1) Придумать, каким образом можно дернуть usrlogoutAction в  Ucontroller
 *      1.2) Как можно разлогиниться
 *      1.3) Как с помощью js сделать редирект на главную страницу
 *      
 *      
 * 2) Когда мы зарегистрировались, у нас остается окно авторизации (Вроде как робит!!!!!!!!!!!)
 * 
 * 
 * 3) Короче при авторизации во время сохранения заказа у нас пропадают поля и так же при регистрации
 * 
 * 
 * 4) в BasketController Добавить проверки на существоание переменных имени, телефона, адреса
 * 
 * 5) Зачем мы делаем POST запрос в ord.tpl в теге form
 */
