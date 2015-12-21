      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Bienvenido(a)</h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div class="col-md-12">
                <div class="box box-primary">
                  <div class="box-header">
                    <h3 class="box-title">Gestionar promociones</h3>
                  </div>
                  <div class="box-body">


                    <div class="form-group">
                      <label>Nombre:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-cart-arrow-down"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="name">
                      </div>
                    </div>
                    
                    <div class="form-group">
                      <label>Tipo:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-money"></i>
                        </div>
                        <select type="text" class="form-control pull-right" id="type">
                          {foreach $types as $key=>$type}
                          <option value="{$key}">{$type}</option>                          
                          {/foreach}
                        </select>
                      </div>
                    </div>

                    <div id="descriptionContainer" class="form-group">
                      <label>Descripción:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-comment-o"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="description">
                      </div>
                    </div>


                    <div class="form-group">
                      <label>Fecha de Promoción:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="rangeDate">
                      </div>
                    </div>

                    <div class="form-group">
                      <button id="btnGuardar" type="button" class="btn btn-primary">Guardar</button>
                    </div>



                  </div><!-- /.box-body -->
                </div><!-- /.box -->


              </div><!-- /.box-body -->

            </div><!-- /.col (right) -->

            <div class="box-body">
              <div class="col-md-12">
                <div class="box box-success">
                  <div class="box-header">
                    <h3 class="box-title">Promociones</h3>
                  </div>
                  <div class="box-body">

                    <div id="table" class="table">

                    </div>

                  </div><!-- /.box-body -->
                </div><!-- /.box -->


              </div><!-- /.box-body -->

            </div><!-- /.col (right) -->
          </div><!-- /.box-body -->

        </div><!-- /.box -->

      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->


