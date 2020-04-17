<style>

.card-deck{
    margin:10rem;
    margin-top:80px;
}
.msgError {
  padding: .84rem 2.14rem;
    font-size: 1rem;
    -webkit-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    transition: all .2s ease-in-out;
    margin: .375rem;
    border: 0;
    -webkit-border-radius: .125rem;
    border-radius: .125rem;
    /*cursor: none;*/
    white-space: normal;
    color: #fff;
}
.msgExito {
  padding: .84rem 2.14rem;
    font-size: 1rem;
    -webkit-transition: all .2s ease-in-out;
    -o-transition: all .2s ease-in-out;
    transition: all .2s ease-in-out;
    margin: .375rem;
    border: 0;
    -webkit-border-radius: .125rem;
    border-radius: .125rem;
    cursor: none;
    white-space: normal;
    color: #fff;
}
.preloader-wrapper.small.active{
    
}
.card-img-top{
   /*  min-height: 25rem; */
}
.text-first:first-letter p{
    text-transform: capitalize;
 }  
 .preloader-wrapper.small  {
  
   margin-left:10px;
   margin-top:0px;
   padding-top:0px;
   margin-bottom: 0px;
   padding-bottom: 0px;
   width:17px;
   height:17px;
 }
 .visible {
    visibility: visible;
}
.invisible {
    visibility: hidden;
}
#subirBoka{
  padding-right: 10px;
}


</style>

<body>
    <section>
            <div class="card-deck">
                <!-- card Boka -->   
                
                
                <div class="card ">
                    <!--Card image-->
                    <div class="view overlay">
                        <img class="card-img-top" src="<?php echo base_url() ?>img/tienda.jpg" alt="Imagen tienda">
                        <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                    <!--Card content-->
                    <div class="card-body">
                        <!--Title-->
                        <h4 class="card-title">Subir archivo Boka</h4>
                        <?php echo form_open_multipart('subirArchivos/subirBoka', array('class' => 'md-form')); ?>
                                <div class="file-field medium">
                                    <div class="btn btn-rounded aqua-gradient">
                                        <span>Seleccionar archivo Boka</span>
                                        <input type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input id="archivoBoka" class="file-path validate"  type="text" placeholder="Archivo Boka">
                                    </div>
                                </div>
                                <?php if ($errorTienda['error']) {
                                    $file = $fileName ? ' (' . $fileName . ')' : '';
                                    echo '<span ><p class="btn-danger msgError">' . (($errorTienda['error'])) . $file . '</p></span>';
                                    } ?>
                                    <?php if ($exitoTienda['fileName']) {
                                    echo '<span ><p class="msgExito btn-success"> Archivo ' . $exitoTienda['fileName'] . ' subido correctamente.<br>' . $exitoTienda['resumen'] . '</p></span>';
                                    //echo '<span ><p class="msgExito btn-success">  ' . $exitoTienda['resumen'] . '</p></span>';
                                } ?>

                                <button type="submit" class="btn btn-success " id="subirBoka"><i class="fa fa-upload" aria-hidden="true"></i> Subir archivo Boka
                                    <div class="preloader-wrapper small" id="spinner-boka">
                                        <div class="spinner-layer spinner-red-only">
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="gap-patch">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </button>

                                <button type="button" class="btn btn-warning cancel-button"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Cancelar</button>
                                
                        </form>
                    </div> 
                </div>
                           

                <!-- card Jamonarium -->  
                
                <div class="card ">
                    <!--Card image-->
                    <div class="view overlay">
                        <img class="card-img-top" src="<?php echo base_url() ?>img/jamonariumcom-logo-1523876113.jpg" alt="Card image cap">
                        <a href="#!">
                            <div class="mask rgba-white-slight"></div>
                        </a>
                    </div>
                    <!--Card content-->
                    <div class="card-body">
                        <!--Title-->
                        <h4 class="card-title">Subir archivo Jamonarium</h4>
                        <?php echo form_open_multipart('subirArchivos/subirJamonarium', array('class' => 'md-form')); ?>
                                <div class="file-field medium">
                                    <div class="btn btn-rounded aqua-gradient">
                                        <span>Seleccionar archivo Jamonarium</span>
                                        <input type="file">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input id="archivoJamonarium" class="file-path validate"  type="text" placeholder="Archivo Jamonarium">
                                    </div>
                                </div>
                                <?php if ($errorJamonarium['error']) {
                                    $file = $fileName ? ' (' . $fileName . ')' : '';
                                    echo '<span ><p class="btn-danger msgError">' . (($errorJamonarium['error'])) . $file . '</p></span>';
                                    } ?>
                                    <?php if ($exitoJamonarium['fileName']) {
                                    echo '<span ><p class="msgExito btn-success"> Archivo ' . $exitoJamonarium['fileName'] . ' subido correctamente</p></span>';
                                } ?>

                                <button type="submit" class="btn btn-success " id="subirJamonarium"><i class="fa fa-upload" aria-hidden="true"></i> Subir archivo Jamonarium
                                    <div class="preloader-wrapper small " id="spinner-jamonarium">
                                        <div class="spinner-layer spinner-green-only">
                                            <div class="circle-clipper left">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="gap-patch">
                                                <div class="circle"></div>
                                            </div>
                                            <div class="circle-clipper right">
                                                <div class="circle"></div>
                                            </div>
                                        </div>
                                    </div>
                                </button>

                                <button type="button" class="btn btn-warning cancel-button"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Cancelar</button>
                                
                        </form>
                    </div> 
                </div>
                            </div>
            </div> 
                            </div>
    </section>

    <script type="text/javascript" src="<?php echo base_url() ?>js/jquery-3.4.1.min.js"></script>
    <script>
    $(document).ready(function(){
        //pone el name en el impout para post
        $('form div div input').attr('name','userfile');

        //cancel accion o nueva subida
        $('.cancel-button, .file-field').click(function(){
        $('.msgError, .msgExito').css('display','none');
        $('#archivoBoka').val('')
        $('form div div input').val('')
        })

        $('#subirBoka').click(function(){
            $('.preloader-wrapper#spinner-boka').addClass('active')
        })

        $('#subirJamonarium').click(function(){
            $('.preloader-wrapper#spinner-jamonarium').addClass('active')
        })
    
    })
</script>                            

</body>