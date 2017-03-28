<modal-book>
<div id="modalbook" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Informaci&oacute;n del Libro</h4>
      </div>
      <div class="modal-body">
          <div if={!ready}>
                    Cargando...........

                  </div>
    <div  if={ready} class="media">

                

                  <div class="media-left">
                    <img class="media-object user-modal-pic" src="/books/{model.image}" >
                   </div>
                  <div class="media-body">
                    <dl>
                      <dt>T&iacute;tulo:</dt>
                      <dd>{model.title}</dd>
                      <dt>Descripcion</dt>
                      <dd>{model.description}</dd>
                      <dt>Fecha Creaci&oacute;n</dt>
                      <dd>{model.created_at}</dd>

 <dt>Categor&iacute;a</dt>
                      <dd>{model.category.name}</dd>
 <dt>Usuario</dt>
                      <dd>{model.user.email}</dd>
          
                    </dl>
                  </div>
                </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<style type="text/css">
  .user-modal-pic{
    width: 200px;
  }
</style>

<script>
      var self = this;
       self.ready=false;
      getData();


      function getData(){
        $.get('/articles/book/' + opts.id, function(result){
              self.model = result;
              self.model.description=$("<div/>").html(result.description).text();

             self.ready = true;
             
              self.update();
          }, 'json')
      }

      this.on('mount', function(){
        $("#modalbook").modal();          
      })


</script>

</modal-book>